<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Concept;
use App\Models\ChiTietConcept;
use App\Models\DichVu;
use App\Models\DichVuDiKem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestSendEmail;

class ClientController extends Controller
{
    // Trang chủ
    public function home()
    {
        $concepts = Concept::where('TrangThai', 1)->get();
        $dichVus = DichVu::where('TrangThai', 1)->get();
        
        return view('client.home', compact('concepts', 'dichVus'));
    }

    // 1. Hiển thị Form Đặt Lịch
    public function bookingForm()
    {
        if (!session()->has('khachhang')) {
            return redirect()->route('client.login')->with('error', 'Vui lòng đăng nhập trước khi đặt lịch!');
        }

        $concepts = Concept::where('TrangThai', 1)->get();
        $chiTietConcepts = ChiTietConcept::where('TrangThai', 1)->get();
        $dichVus = DichVu::where('TrangThai', 1)->get();
        $dichVuDiKems = DichVuDiKem::where('TrangThai', 1)->get();
        $khungGios = DB::table('khunggio')->where('TrangThai', 1)->get();

        $khachHang = session('khachhang');

        return view('client.booking', compact('concepts', 'chiTietConcepts', 'dichVus', 'dichVuDiKems', 'khungGios', 'khachHang'));
    }

    // 2. Xử lý Lưu Đơn Đặt Lịch và KHỞI TẠO dữ liệu sang hoadon, thanhtoan, lichsuthanhtoan, thongbao
    public function storeBooking(Request $request)
    {
        $request->validate([
            'HoTen' => 'required',
            'SoDienThoai' => 'required',
            'Email' => 'required|email',
            'MaConcept' => 'required',
            'MaDichVu' => 'required',
            'NgayChup' => 'required|date',
            'MaKhungGio' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // 1. Sinh mã Đặt lịch tự động an toàn
            $maxDL = DB::table('datlich')->selectRaw("MAX(CAST(SUBSTRING(MaDatLich, 3) AS UNSIGNED)) as max_id")->value('max_id');
            $maDatLich = 'DL' . str_pad(($maxDL ? $maxDL + 1 : 1), 3, '0', STR_PAD_LEFT);

            $khachHang = session('khachhang');
            $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);
            
            $taiKhoan = session('taikhoan');
            $maTaiKhoan = is_array($taiKhoan) ? ($taiKhoan['MaTaiKhoan'] ?? null) : ($taiKhoan->MaTaiKhoan ?? null);

            $lichChup = DB::table('lichchup')
                ->where('NgayChup', $request->NgayChup)
                ->where('MaKhungGio', $request->MaKhungGio)
                ->first();

            $maLichChup = $lichChup ? $lichChup->MaLichChup : null;

            if (!$maLichChup) {
                $maxLC = DB::table('lichchup')->selectRaw("MAX(CAST(SUBSTRING(MaLichChup, 3) AS UNSIGNED)) as max_id")->value('max_id');
                $maLichChup = 'LC' . str_pad(($maxLC ? $maxLC + 1 : 1), 3, '0', STR_PAD_LEFT);
                DB::table('lichchup')->insert([
                    'MaLichChup' => $maLichChup,
                    'NgayChup' => $request->NgayChup,
                    'MaKhungGio' => $request->MaKhungGio,
                    'TrangThai' => 'DaDat'
                ]);
            }

            // Lưu bảng datlich
            DB::table('datlich')->insert([
                'MaDatLich' => $maDatLich,
                'NgayDat' => now(),
                'TrangThai' => 'Chờ thanh toán',
                'SoLuongNguoi' => 1,
                'NgayCapNhat' => now(),
                'GhiChu' => $request->GhiChu,
                'LyDoTuChoi' => null,
                'MaKhachHang' => $maKhachHang,
                'MaLichChup' => $maLichChup,
                'MaDichVu' => $request->MaDichVu,
                'MaConcept' => $request->MaConcept,
                'MaChiTietConcept' => $request->MaChiTietConcept,
            ]);

            // Tính tiền dịch vụ & dịch vụ đi kèm
            $dichVu = DB::table('dichvu')->where('MaDichVu', $request->MaDichVu)->first();
            $tongTienDvChinh = $dichVu ? $dichVu->DonGia : 0;
            $tongTienAddons = 0;

            if ($request->has('dich_vu_di_kem')) {
                foreach ($request->dich_vu_di_kem as $maDVDK => $soLuong) {
                    $soLuong = (int)$soLuong;
                    if ($soLuong > 0) {
                        $dkInfo = DB::table('dichvudikem')->where('MaDichVuDiKem', $maDVDK)->first();
                        $donGia = $dkInfo ? $dkInfo->DonGia : 0;
                        $thanhTien = $soLuong * $donGia;
                        $tongTienAddons += $thanhTien;

                        DB::table('chitietdichvudikem')->insert([
                            'MaDatLich' => $maDatLich,
                            'MaDichVuDiKem' => $maDVDK,
                            'SoLuong' => $soLuong,
                            'DonGiaApDung' => $donGia,
                            'ThanhTien' => $thanhTien
                        ]);
                    }
                }
            }

            $tongTien = $tongTienDvChinh + $tongTienAddons;
            $tienCoc = $tongTien * 0.3;

            // 2. Sinh mã Hóa đơn tự động an toàn
            $maxHD = DB::table('hoadon')->selectRaw("MAX(CAST(SUBSTRING(MaHoaDon, 3) AS UNSIGNED)) as max_id")->value('max_id');
            $maHoaDon = 'HD' . str_pad(($maxHD ? $maxHD + 1 : 1), 3, '0', STR_PAD_LEFT);

            DB::table('hoadon')->insert([
                'MaHoaDon' => $maHoaDon,
                'TongTien' => $tongTien,
                'SoTienGiam' => 0,
                'TienCoc' => $tienCoc,
                'TongTienPhaiTra' => $tongTien,
                'SoTienDaThanhToan' => 0,
                'SoTienConLai' => $tongTien,
                'TrangThai' => 'Chờ thanh toán',
                'NgayLap' => now(),
                'NgayCapNhat' => now(),
                'MaDatLich' => $maDatLich,
                'MaKhachHang' => $maKhachHang,
                'MaVoucher' => null
            ]);

            // 3. Sinh mã Thanh toán tự động an toàn
            $maxTT = DB::table('thanhtoan')->selectRaw("MAX(CAST(SUBSTRING(MaThanhToan, 3) AS UNSIGNED)) as max_id")->value('max_id');
            $maThanhToanMoi = 'TT' . str_pad(($maxTT ? $maxTT + 1 : 1), 3, '0', STR_PAD_LEFT);

            DB::table('thanhtoan')->insert([
                'MaThanhToan'   => $maThanhToanMoi,
                'SoTien'        => $tienCoc,
                'LoaiThanhToan' => 'Đặt cọc',
                'PhuongThuc'    => 'Chuyển khoản QR',
                'TrangThai'     => 'Chờ xử lý',
                'ThoiGianTao'   => now(),
                'MaGiaoDich'    => 'GD' . date('YmdHis'),
                'NgayCapNhat'   => now(),
                'MaHoaDon'      => $maHoaDon,
            ]);

            // 4. Sinh mã Lịch sử thanh toán tự động an toàn (Dùng PHP quét chuẩn 6 chữ số 0)
            if (DB::getSchemaBuilder()->hasTable('lichsuthanhtoan')) {
                $allLSTTCodes = DB::table('lichsuthanhtoan')->pluck('MaLichSuThanhToan');
                $maxLSTTNum = 0;
                foreach ($allLSTTCodes as $code) {
                    if (preg_match('/LSTT(\d+)/i', $code, $matches)) {
                        $num = (int)$matches[1];
                        if ($num > $maxLSTTNum) {
                            $maxLSTTNum = $num;
                        }
                    }
                }
                $nextLSTTId = $maxLSTTNum + 1;

                do {
                    $maLichSuThanhToan = 'LSTT' . str_pad($nextLSTTId, 6, '0', STR_PAD_LEFT);
                    $existsLSTT = DB::table('lichsuthanhtoan')->where('MaLichSuThanhToan', $maLichSuThanhToan)->exists();
                    if ($existsLSTT) {
                        $nextLSTTId++;
                    }
                } while ($existsLSTT);

                DB::table('lichsuthanhtoan')->insert([
                    'MaLichSuThanhToan' => $maLichSuThanhToan,
                    'TrangThaiCu' => null,
                    'TrangThaiMoi' => 'Chờ xử lý',
                    'ThoiGianCapNhat' => now(),
                    'NoiDung' => 'Khởi tạo giao dịch đặt cọc chờ thanh toán',
                    'MaThanhToan' => $maThanhToanMoi
                ]);
            }

            // 5. Sinh mã Thông báo tự động an toàn
            if (DB::getSchemaBuilder()->hasTable('thongbao')) {
                $maxTB = DB::table('thongbao')->selectRaw("MAX(CAST(SUBSTRING(MaThongBao, 3) AS UNSIGNED)) as max_id")->value('max_id');
                $maThongBao = 'TB' . str_pad(($maxTB ? $maxTB + 1 : 1), 3, '0', STR_PAD_LEFT);

                DB::table('thongbao')->insert([
                    'MaThongBao' => $maThongBao,
                    'MaKhachHang' => $maKhachHang,
                    'TieuDe' => 'Đơn đặt lịch mới đang chờ thanh toán',
                    'NoiDung' => 'Đơn đặt lịch ' . $maDatLich . ' đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.',
                    'ThoiGianTao' => now(),
                    'TrangThaiDoc' => 0,
                    'MaTaiKhoan' => $maTaiKhoan,
                    'MaDatLich' => $maDatLich
                ]);
            }

            DB::commit();
            return redirect()->route('client.checkout', ['maDatLich' => $maDatLich]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi tạo đơn đặt lịch: ' . $e->getMessage()])->withInput();
        }
    }

    // 3. Hiển thị Giao diện Thanh toán Checkout
    public function showCheckout($maDatLich)
    {
        $datLich = DB::table('datlich')->where('MaDatLich', $maDatLich)->first();

        if (!$datLich) {
            return redirect()->route('client.booking.form')->withErrors(['error' => 'Đơn đặt lịch không tồn tại!']);
        }

        $lichChup = DB::table('lichchup')->where('MaLichChup', $datLich->MaLichChup)->first();
        $khungGio = $lichChup ? DB::table('khunggio')->where('MaKhungGio', $lichChup->MaKhungGio)->first() : null;

        $concept = DB::table('concept')->where('MaConcept', $datLich->MaConcept)->first();
        $maChiTietConcept = property_exists($datLich, 'MaChiTietConcept') ? $datLich->MaChiTietConcept : null;
        $chiTietConcept = $maChiTietConcept ? DB::table('chitietconcept')->where('MaChiTietConcept', $maChiTietConcept)->first() : null;

        $dichVu = DB::table('dichvu')->where('MaDichVu', $datLich->MaDichVu)->first();

        $tongTienDichVuChinh = $dichVu ? $dichVu->DonGia : 0;
        $dichVuDiKems = DB::table('chitietdichvudikem')
            ->join('dichvudikem', 'chitietdichvudikem.MaDichVuDiKem', '=', 'dichvudikem.MaDichVuDiKem')
            ->where('chitietdichvudikem.MaDatLich', $maDatLich)
            ->get();

        $tongTienAddons = $dichVuDiKems->sum('ThanhTien');
        $tongTien = $tongTienDichVuChinh + $tongTienAddons;
        $tienCoc = $tongTien * 0.3;

        $datLich->TongTien = $tongTien;
        $datLich->TienCoc = $tienCoc;
        $datLich->NgayChup = $lichChup ? $lichChup->NgayChup : null;

        $khachHang = session('khachhang');
        $taiKhoan = session('taikhoan');
        
        $datLich->HoTenKhach = data_get($khachHang, 'HoTen', 'Khách hàng');
        $datLich->SoDienThoaiKhach = data_get($khachHang, 'SoDienThoai', '');
        $maKhachHang = data_get($khachHang, 'MaKhachHang');
        $maTaiKhoan = data_get($taiKhoan, 'MaTaiKhoan');

        $soLanMua = DB::table('datlich')
            ->where('MaKhachHang', $maKhachHang)
            ->whereIn('TrangThai', ['Đã xác nhận', 'Đã hoàn thành'])
            ->count();

        $tongChiTieu = DB::table('datlich')
            ->join('dichvu', 'datlich.MaDichVu', '=', 'dichvu.MaDichVu')
            ->where('datlich.MaKhachHang', $maKhachHang)
            ->whereIn('datlich.TrangThai', ['Đã xác nhận', 'Đã hoàn thành'])
            ->sum('dichvu.DonGia');

        $laKhachMoi = ($soLanMua == 0);

        $allVouchers = DB::table('voucher')
            ->where('TrangThai', 1)
            ->whereDate('NgayBatDau', '<=', now())
            ->whereDate('NgayKetThuc', '>=', now())
            ->get();

        $vouchers = [];

        foreach ($allVouchers as $v) {
            $maVoucher = $v->MaVoucher;
            $hopLe = false;

            if (in_array($maVoucher, ['VC001', 'VC002']) && $laKhachMoi) {
                $hopLe = true;
            } elseif (in_array($maVoucher, ['VC003', 'VC004']) && !empty($datLich->MaConcept)) {
                $hopLe = true;
            } elseif ($maVoucher == 'VC_BAC' && $tongChiTieu >= 15000000) {
                $hopLe = true;
            } elseif ($maVoucher == 'VC_VANG' && $tongChiTieu >= 20000000) {
                $hopLe = true;
            } elseif ($maVoucher == 'VC_KIMCUONG' && $tongChiTieu >= 25000000) {
                $hopLe = true;
            } elseif ($maVoucher == 'VC012') {
                $hopLe = true;
            } elseif ($maVoucher == 'VC013') {
                $hopLe = true;
            } elseif ($maVoucher == 'VC014' && $soLanMua >= 5) {
                $hopLe = true;
            } elseif ($maVoucher == 'VC015' && $soLanMua == 1) {
                $hopLe = true;
            }

            if ($hopLe) {
                $vouchers[] = $v;
            }
        }

        $vouchers = collect($vouchers);

        return view('client.checkout', compact('datLich', 'concept', 'chiTietConcept', 'dichVu', 'khungGio', 'dichVuDiKems', 'vouchers'));
    }

    // 4. Xử lý Lưu Thanh Toán & Cập nhật các bảng hoadon, thanhtoan, lichsuthanhtoan, thongbao
    // 4. Xử lý thanh toán và cập nhật hóa đơn, thanh toán, lịch sử, thông báo
public function processCheckout(Request $request, $maDatLich)
{
    $request->validate([
        'LoaiThanhToan' => 'required',
        'PhuongThuc' => 'required',
        'SoTien' => 'required|numeric|min:1'
    ]);

    $datLich = DB::table('datlich')
        ->where('MaDatLich', $maDatLich)
        ->first();

    if (!$datLich) {
        return redirect()
            ->route('client.booking.form')
            ->withErrors([
                'error' => 'Đơn đặt lịch không tồn tại!'
            ]);
    }

    $khachHang = session('khachhang');

    $maKhachHang = is_array($khachHang)
        ? ($khachHang['MaKhachHang'] ?? null)
        : ($khachHang->MaKhachHang ?? null);

    $emailKhach = data_get($khachHang, 'Email') ?? $request->Email;

    $taiKhoan = session('taikhoan');

    $maTaiKhoan = is_array($taiKhoan)
        ? ($taiKhoan['MaTaiKhoan'] ?? null)
        : ($taiKhoan->MaTaiKhoan ?? null);

    $soTienGiam = (float) ($request->SoTienGiam ?? 0);
    $tongTien = (float) ($request->TongTienBanDau ?? $request->SoTien);
    $tongTienPhaiTra = $tongTien - $soTienGiam;
    $soTienThanhToan = (float) $request->SoTien;

    $trangThaiHoaDon = ($request->LoaiThanhToan == 'Đặt cọc')
        ? 'Đã đặt cọc'
        : 'Đã thanh toán';

    DB::beginTransaction();

    try {

        // =================================================
        // 1. TÌM HOẶC TẠO HÓA ĐƠN
        // =================================================

        $existingHD = DB::table('hoadon')
            ->where('MaDatLich', $maDatLich)
            ->lockForUpdate()
            ->first();

        if ($existingHD) {

            $maHoaDon = $existingHD->MaHoaDon;

            DB::table('hoadon')
                ->where('MaHoaDon', $maHoaDon)
                ->update([
                    'SoTienGiam' => $soTienGiam,

                    'TienCoc' => ($request->LoaiThanhToan == 'Đặt cọc')
                        ? $soTienThanhToan
                        : $existingHD->TienCoc,

                    'TongTienPhaiTra' => $tongTienPhaiTra,

                    'SoTienDaThanhToan' => $soTienThanhToan,

                    'SoTienConLai' => max(
                        0,
                        $tongTienPhaiTra - $soTienThanhToan
                    ),

                    'TrangThai' => $trangThaiHoaDon,

                    'NgayCapNhat' => now(),

                    'MaVoucher' => $request->MaVoucher
                        ?? $existingHD->MaVoucher
                ]);

        } else {

            // Sinh mã hóa đơn theo số thứ tự lớn nhất
            $maxHD = DB::table('hoadon')
                ->selectRaw(
                    "MAX(CAST(SUBSTRING(MaHoaDon, 3) AS UNSIGNED)) AS max_id"
                )
                ->value('max_id');

            $nextHD = ($maxHD ?? 0) + 1;

            $maHoaDon = 'HD' . str_pad(
                $nextHD,
                3,
                '0',
                STR_PAD_LEFT
            );

            DB::table('hoadon')->insert([
                'MaHoaDon' => $maHoaDon,
                'TongTien' => $tongTien,
                'SoTienGiam' => $soTienGiam,

                'TienCoc' => ($request->LoaiThanhToan == 'Đặt cọc')
                    ? $soTienThanhToan
                    : 0,

                'TongTienPhaiTra' => $tongTienPhaiTra,
                'SoTienDaThanhToan' => $soTienThanhToan,

                'SoTienConLai' => max(
                    0,
                    $tongTienPhaiTra - $soTienThanhToan
                ),

                'TrangThai' => $trangThaiHoaDon,
                'NgayLap' => now(),
                'NgayCapNhat' => now(),
                'MaDatLich' => $maDatLich,
                'MaKhachHang' => $maKhachHang,
                'MaVoucher' => $request->MaVoucher ?? null
            ]);
        }


        // =================================================
        // 2. TÌM HOẶC TẠO THANH TOÁN
        // =================================================

        $existingTT = DB::table('thanhtoan')
            ->where('MaHoaDon', $maHoaDon)
            ->lockForUpdate()
            ->first();

        if ($existingTT) {

            $maThanhToan = $existingTT->MaThanhToan;

            // Cập nhật thanh toán.
            // Trigger TRG_ThanhToan_LuuNhatKy sẽ tự ghi lịch sử
            // khi TrangThai thay đổi.
            DB::table('thanhtoan')
                ->where('MaThanhToan', $maThanhToan)
                ->update([
                    'SoTien' => $soTienThanhToan,
                    'LoaiThanhToan' => $request->LoaiThanhToan,
                    'PhuongThuc' => $request->PhuongThuc,
                    'TrangThai' => 'Thành công',
                    'ThoiGianThanhToan' => now(),
                    'NgayCapNhat' => now()
                ]);

        } else {

            // Sinh mã thanh toán
            $maxTT = DB::table('thanhtoan')
                ->selectRaw(
                    "MAX(CAST(SUBSTRING(MaThanhToan, 3) AS UNSIGNED)) AS max_id"
                )
                ->value('max_id');

            $nextTT = ($maxTT ?? 0) + 1;

            $maThanhToan = 'TT' . str_pad(
                $nextTT,
                3,
                '0',
                STR_PAD_LEFT
            );

            DB::table('thanhtoan')->insert([
                'MaThanhToan' => $maThanhToan,
                'SoTien' => $soTienThanhToan,
                'LoaiThanhToan' => $request->LoaiThanhToan,
                'PhuongThuc' => $request->PhuongThuc,
                'TrangThai' => 'Thành công',
                'ThoiGianTao' => now(),
                'ThoiGianThanhToan' => now(),
                'MaGiaoDich' => 'GD' . date('YmdHis') . rand(100, 999),
                'NgayCapNhat' => now(),
                'MaHoaDon' => $maHoaDon
            ]);

            // Trường hợp chưa có thanh toán từ lúc đặt lịch:
            // tạo lịch sử thành công ban đầu tại đây.
            // Trường hợp UPDATE ở nhánh trên đã do trigger ghi,
            // vì vậy không ghi lịch sử lần thứ hai.

            $maxLSTT = DB::table('lichsuthanhtoan')
                ->selectRaw(
                    "MAX(CAST(SUBSTRING(MaLichSuThanhToan, 5) AS UNSIGNED)) AS max_id"
                )
                ->value('max_id');

            $nextLSTT = ($maxLSTT ?? 0) + 1;

            $maLichSuThanhToan = 'LSTT' . str_pad(
                $nextLSTT,
                6,
                '0',
                STR_PAD_LEFT
            );

            DB::table('lichsuthanhtoan')->insert([
                'MaLichSuThanhToan' => $maLichSuThanhToan,
                'TrangThaiCu' => null,
                'TrangThaiMoi' => 'Thành công',
                'ThoiGianCapNhat' => now(),
                'NoiDung' => 'Thanh toán thành công '
                    . number_format($soTienThanhToan)
                    . ' VNĐ qua '
                    . $request->PhuongThuc,
                'MaThanhToan' => $maThanhToan
            ]);
        }


        // =================================================
        // 3. CẬP NHẬT TRẠNG THÁI ĐẶT LỊCH
        // =================================================

        DB::table('datlich')
            ->where('MaDatLich', $maDatLich)
            ->update([
                'TrangThai' => 'Đã xác nhận',
                'NgayCapNhat' => now()
            ]);

        // Không tự INSERT lichsudatlich tại đây.
        // Trigger TRG_DatLich_LuuNhatKy đã tự ghi lịch sử
        // khi trạng thái đặt lịch thay đổi.


        // =================================================
        // 4. TẠO THÔNG BÁO THANH TOÁN THÀNH CÔNG
        // =================================================

        if (DB::getSchemaBuilder()->hasTable('thongbao')) {

            $maxTB = DB::table('thongbao')
                ->selectRaw(
                    "MAX(CAST(SUBSTRING(MaThongBao, 3) AS UNSIGNED)) AS max_id"
                )
                ->value('max_id');

            $nextTB = ($maxTB ?? 0) + 1;

            $maThongBao = 'TB' . str_pad(
                $nextTB,
                3,
                '0',
                STR_PAD_LEFT
            );

            DB::table('thongbao')->insert([
                'MaThongBao' => $maThongBao,
                'MaKhachHang' => $maKhachHang,

                'TieuDe' => 'Xác nhận thanh toán thành công',

                'NoiDung' => 'Hệ thống đã ghi nhận thanh toán thành công cho đơn hàng '
                    . $maDatLich
                    . ' (Hóa đơn: '
                    . $maHoaDon
                    . ').',

                'ThoiGianTao' => now(),
                'TrangThaiDoc' => 0,
                'MaTaiKhoan' => $maTaiKhoan,
                'MaDatLich' => $maDatLich
            ]);
        }


        // =================================================
        // 5. HOÀN TẤT GIAO DỊCH
        // =================================================

        DB::commit();


        // =================================================
        // 6. GỬI EMAIL HÓA ĐƠN
        // =================================================

        if (!empty($emailKhach)) {

            try {

                $hoaDonObj = (object) [
                    'MaHoaDon' => $maHoaDon,
                    'SoTienDaThanhToan' => $soTienThanhToan
                ];

                Notification::route('mail', $emailKhach)
                    ->notify(new TestSendEmail($hoaDonObj));

            } catch (\Exception $ex) {

                \Log::error(
                    'Lỗi gửi email: ' . $ex->getMessage()
                );
            }
        }


        // =================================================
        // 7. HIỂN THỊ TRANG THANH TOÁN THÀNH CÔNG
        // =================================================

        return view(
            'client.payment_success',
            compact(
                'maDatLich',
                'maHoaDon',
                'soTienThanhToan'
            )
        );

    } catch (\Exception $e) {

        DB::rollBack();

        \Log::error(
            'Lỗi xử lý thanh toán: ' . $e->getMessage()
        );

        return back()
            ->withErrors([
                'error' => 'Có lỗi xảy ra khi xử lý thanh toán: '
                    . $e->getMessage()
            ])
            ->withInput();
    }
}

    // 5. Màn hình Lịch Sử Đặt Lịch
    public function bookingHistory()
    {
        $khachHang = session('khachhang');
        $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);

        if (!$maKhachHang) {
            return redirect()->route('client.login')->with('error', 'Vui lòng đăng nhập để xem lịch sử!');
        }

        $danhSachDatLich = DB::table('datlich')
            ->leftJoin('dichvu', 'datlich.MaDichVu', '=', 'dichvu.MaDichVu')
            ->leftJoin('concept', 'datlich.MaConcept', '=', 'concept.MaConcept')
            ->leftJoin('lichchup', 'datlich.MaLichChup', '=', 'lichchup.MaLichChup')
            ->leftJoin('khunggio', 'lichchup.MaKhungGio', '=', 'khunggio.MaKhungGio')
            ->leftJoin('hoadon', 'datlich.MaDatLich', '=', 'hoadon.MaDatLich')
            ->where('datlich.MaKhachHang', $maKhachHang)
            ->select(
                'datlich.*',
                'dichvu.TenDichVu',
                'dichvu.DonGia as GiaDichVu',
                'concept.TenConcept',
                'lichchup.NgayChup',
                'khunggio.GioBatDau',
                'khunggio.GioKetThuc',
                'hoadon.MaHoaDon',
                'hoadon.TongTienPhaiTra',
                'hoadon.TienCoc',
                'hoadon.SoTienDaThanhToan',
                'hoadon.SoTienConLai'
            )
            ->orderBy('datlich.NgayDat', 'desc')
            ->get();

        foreach ($danhSachDatLich as $item) {
            // Truy vấn trực tiếp cột TrangThaiCu từ bảng lichsudatlich (lấy dòng log mới nhất)
            $latestLog = DB::table('lichsudatlich')
                ->where('MaDatLich', $item->MaDatLich)
                ->orderBy('ThoiGianThaoTac', 'desc')
                ->first();

            // Nếu có log, lấy TrangThaiCu từ CSDL, ngược lại mặc định là 'Chờ thanh toán' hoặc trạng thái khởi tạo
            $item->TrangThaiCu = $latestLog ? $latestLog->TrangThaiCu : 'Chờ thanh toán';
            $item->TrangThaiMoi = $item->TrangThai;

            // Tính toán tổng tiền
            if (empty($item->TongTienPhaiTra) || $item->TongTienPhaiTra == 0) {
                $tongTienDvChinh = $item->GiaDichVu ?? 0;
                $tongTienAddons = DB::table('chitietdichvudikem')
                    ->where('MaDatLich', $item->MaDatLich)
                    ->sum('ThanhTien');
                $item->TongTienPhaiTra = $tongTienDvChinh + $tongTienAddons;
            }

            if (!empty($item->MaHoaDon)) {
                $item->SoTienDaThanhToan = $item->SoTienDaThanhToan ?? 0;
                $item->SoTienConLai = max(0, $item->TongTienPhaiTra - $item->SoTienDaThanhToan);
            } else {
                $item->SoTienDaThanhToan = 0;
                $item->SoTienConLai = $item->TongTienPhaiTra;
            }
        }

        return view('client.history', compact('danhSachDatLich'));
    }

    // API lấy danh sách khung giờ khả dụng theo ngày chụp
    public function getAvailableTimeSlots(Request $request)
    {
        $ngayChup = $request->input('ngay');
        
        if (!$ngayChup) {
            return response()->json([]);
        }

        $khungGios = DB::table('khunggio')->orderBy('GioBatDau')->get();
        $result = [];

        foreach ($khungGios as $kg) {
            $lichChupList = DB::table('lichchup')
                ->where('NgayChup', $ngayChup)
                ->where('MaKhungGio', $kg->MaKhungGio)
                ->get();

            $conTroong = true;
            $soLuongDat = 0;
            $sucChua = property_exists($kg, 'SucChuaToiDa') ? $kg->SucChuaToiDa : 2;

            foreach ($lichChupList as $lichChup) {
                $trangThai = trim(strtolower($lichChup->TrangThai));
                
                if (in_array($trangThai, ['Da dat', 'dadat', 'đã đặt', 'tam khoa', 'Tam khoa', 'tạm khóa', 'da dat', 'Con trong'])) {
                    $conTroong = false;
                    break;
                }

                $count = DB::table('datlich')
                    ->where('MaLichChup', $lichChup->MaLichChup)
                    ->whereIn('TrangThai', ['Chờ xác nhận', 'Đã xác nhận', 'Chờ thanh toán', 'Đã hoàn thành', 'Đã hủy', 'Bị từ chối'])
                    ->count();
                
                $soLuongDat += $count;
            }

            if ($soLuongDat >= $sucChua) {
                $conTroong = false;
            }

            $result[] = [
                'MaKhungGio' => $kg->MaKhungGio,
                'TenHienThi' => $kg->GioBatDau . ' - ' . $kg->GioKetThuc,
                'ConTroong' => $conTroong,
                'SoLuongHienTai' => $soLuongDat,
                'SucChuaToiDa' => $sucChua
            ];
        }

        return response()->json($result);
    }


    /**
     * Khách hàng gửi yêu cầu thay đổi lịch đặt
     */
    public function requestChangeBooking(Request $request, $maDatLich)
    {
        $request->validate([
            'NgayChupMoi' => 'required|date|after_or_equal:today',
            'MaKhungGioMoi' => 'required',
            'LyDo' => 'required|string|max:255'
        ]);

        $datLich = DB::table('datlich')->where('MaDatLich', $maDatLich)->first();
        if (!$datLich) {
            return back()->withErrors(['error' => 'Đơn đặt lịch không tồn tại!']);
        }

        // Kiểm tra xem đơn có ở trạng thái cho phép đổi không (VD: 'Đã xác nhận' hoặc 'Chờ xác nhận')
        if (!in_array($datLich->TrangThai, ['Đã xác nhận', 'Chờ xác nhận'])) {
            return back()->withErrors(['error' => 'Đơn đặt lịch này không thể gửi yêu cầu đổi lịch!']);
        }

        DB::beginTransaction();
        try {
            // Cập nhật trạng thái hoặc lưu vào bảng yêu cầu thay đổi / ghi chú lịch đặt
            DB::table('datlich')->where('MaDatLich', $maDatLich)->update([
                'TrangThai' => 'Đang yêu cầu đổi lịch',
                'GhiChu' => trim(($datLich->GhiChu ?? '') . " | [YÊU CẦU ĐỔI LỊCH] Ngày mới: {$request->NgayChupMoi}, Khung giờ: {$request->MaKhungGioMoi}. Lý do: {$request->LyDo}"),
                'NgayCapNhat' => now()
            ]);

            // Ghi log lịch sử đặt lịch (bảng lichsudatlich)
            if (DB::getSchemaBuilder()->hasTable('lichsudatlich')) {
                $allCodes = DB::table('lichsudatlich')->pluck('MaLichSuDatLich');
                $maxNum = 0;
                foreach ($allCodes as $code) {
                    if (preg_match('/LS(\d+)/i', $code, $matches)) {
                        $num = (int)$matches[1];
                        if ($num > $maxNum) $maxNum = $num;
                    }
                }
                $nextLSId = $maxNum + 1;
                $maLichSuDatLich = 'LS' . str_pad($nextLSId, 6, '0', STR_PAD_LEFT);

                DB::table('lichsudatlich')->insert([
                    'MaLichSuDatLich' => $maLichSuDatLich,
                    'TrangThaiCu' => $datLich->TrangThai,
                    'TrangThaiMoi' => 'Đang yêu cầu đổi lịch',
                    'ThoiGianThaoTac' => now(),
                    'HanhDong' => 'Yêu cầu đổi lịch',
                    'LyDo' => $request->LyDo,
                    'GhiChu' => 'Khách hàng yêu cầu đổi sang ngày: ' . $request->NgayChupMoi,
                    'MaDatLich' => $maDatLich
                ]);
            }

            DB::commit();
            return back()->with('success', 'Đã gửi yêu cầu thay đổi lịch thành công. Studio sẽ liên hệ xác nhận lại với bạn!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    /**
     * Khách hàng gửi yêu cầu hủy lịch đặt
     */
    public function requestCancelBooking(Request $request, $maDatLich)
    {
        $request->validate([
            'LyDoHuy' => 'required|string|max:255'
        ]);

        $datLich = DB::table('datlich')->where('MaDatLich', $maDatLich)->first();
        if (!$datLich) {
            return back()->withErrors(['error' => 'Đơn đặt lịch không tồn tại!']);
        }

        if (!in_array($datLich->TrangThai, ['Đã xác nhận', 'Chờ xác nhận', 'Chờ thanh toán'])) {
            return back()->withErrors(['error' => 'Đơn đặt lịch này không thể hủy!']);
        }

        DB::beginTransaction();
        try {
            DB::table('datlich')->where('MaDatLich', $maDatLich)->update([
                'TrangThai' => 'Đang yêu cầu hủy',
                'LyDoTuChoi' => $request->LyDoHuy,
                'NgayCapNhat' => now()
            ]);

            // Ghi log lịch sử đặt lịch
            if (DB::getSchemaBuilder()->hasTable('lichsudatlich')) {
                $allCodes = DB::table('lichsudatlich')->pluck('MaLichSuDatLich');
                $maxNum = 0;
                foreach ($allCodes as $code) {
                    if (preg_match('/LS(\d+)/i', $code, $matches)) {
                        $num = (int)$matches[1];
                        if ($num > $maxNum) $maxNum = $num;
                    }
                }
                $nextLSId = $maxNum + 1;
                $maLichSuDatLich = 'LS' . str_pad($nextLSId, 6, '0', STR_PAD_LEFT);

                DB::table('lichsudatlich')->insert([
                    'MaLichSuDatLich' => $maLichSuDatLich,
                    'TrangThaiCu' => $datLich->TrangThai,
                    'TrangThaiMoi' => 'Đang yêu cầu hủy',
                    'ThoiGianThaoTac' => now(),
                    'HanhDong' => 'Yêu cầu hủy lịch',
                    'LyDo' => $request->LyDoHuy,
                    'GhiChu' => 'Khách hàng gửi yêu cầu hủy lịch.',
                    'MaDatLich' => $maDatLich
                ]);
            }

            DB::commit();
            return back()->with('success', 'Đã gửi yêu cầu hủy lịch thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    // --- QUẢN LÝ KHUNG GIỜ & LỊCH LÀM VIỆC ---
    public function quanLyKhungGio(Request $request)
    {
        $danhSachKhungGio = DB::table('khunggio')->orderBy('GioBatDau', 'asc')->paginate(10);
        return view('admin.khunggio.index', compact('danhSachKhungGio'));
    }

    public function themKhungGio()
    {
        return view('admin.khunggio.them');
    }

    public function luuKhungGio(Request $request)
    {
        $request->validate([
            'GioBatDau' => 'required',
            'GioKetThuc' => 'required',
        ]);

        $maKhungGio = 'KG' . rand(100, 999);

        DB::table('khunggio')->insert([
            'MaKhungGio' => $maKhungGio,
            'GioBatDau' => $request->GioBatDau,
            'GioKetThuc' => $request->GioKetThuc,
            'TrangThai' => 'Hoạt động',
        ]);

        return redirect()->route('admin.khunggio.index')->with('success', 'Thêm khung giờ làm việc thành công!');
    }

    public function xoaKhungGio($id)
    {
        DB::table('khunggio')->where('MaKhungGio', $id)->delete();
        return back()->with('success', 'Đã xóa khung giờ thành công!');
    }

    public function danhSachThongBao()
    {
        $khachHang = session('khachhang');
        if (!$khachHang) {
            return redirect()->route('client.login')->with('error', 'Vui lòng đăng nhập để xem thông báo!');
        }

        $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);
        
        $danhSachThongBao = DB::table('thongbao')
            ->where('MaKhachHang', $maKhachHang)
            ->orderBy('ThoiGianTao', 'desc')
            ->paginate(7);

        return view('client.thongbao', compact('danhSachThongBao'));
    }

    public function doiTrangThaiThongBao($id)
    {
        $tb = DB::table('thongbao')->where('MaThongBao', $id)->first();
        if ($tb) {
            // Nếu TrangThaiDoc là 0 (Chưa đọc) thì đổi thành 1 (Đã đọc) và ngược lại
            $trangThaiMoi = ($tb->TrangThaiDoc == 0) ? 1 : 0;
            
            DB::table('thongbao')->where('MaThongBao', $id)->update(['TrangThaiDoc' => $trangThaiMoi]);
        }
        return back();
    }

    public function danhDauDaDoc($id)
    {
        DB::table('thongbao')->where('MaThongBao', $id)->update(['TrangThaiDoc' => 'Đã đọc']);
        return back();
    }

    public function formHoSo()
    {
        $khachHang = session('khachhang');
        if (!$khachHang) {
            return redirect()->route('client.login')->with('error', 'Vui lòng đăng nhập!');
        }

        $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);

        // Lấy thông tin mới nhất từ bảng khachhang
        $thongTin = DB::table('khachhang')->where('MaKhachHang', $maKhachHang)->first();

        return view('client.hosocanhan', compact('thongTin'));
    }

    public function capNhatHoSo(Request $request)
    {
        $khachHang = session('khachhang');
        if (!$khachHang) {
            return redirect()->route('client.login');
        }

        $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);

        $request->validate([
            'HoTen' => 'required|string|max:255',
            'SoDienThoai' => 'required|string|max:15',
            'Email' => 'required|email|max:255',
        ]);

        DB::table('khachhang')->where('MaKhachHang', $maKhachHang)->update([
            'HoTen' => $request->HoTen,
            'SoDienThoai' => $request->SoDienThoai,
            'Email' => $request->Email,
            'DiaChi' => $request->DiaChi,
        ]);

        // Cập nhật lại session
        $khachHangMoi = DB::table('khachhang')->where('MaKhachHang', $maKhachHang)->first();
        session(['khachhang' => $khachHangMoi]);

        return back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }

    public function formDoiMatKhau()
    {
        return view('client.doimatkhau');
    }

    public function xuLyDoiMatKhau(Request $request)
    {
        $request->validate([
            'MatKhauCu' => 'required',
            'MatKhauMoi' => 'required|min:6|confirmed', 
        ]);

        $khachHang = session('khachhang');
        $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);

        $user = DB::table('khachhang')->where('MaKhachHang', $maKhachHang)->first();

        if (!$user || $user->MatKhau !== $request->MatKhauCu) {
            return back()->withErrors(['MatKhauCu' => 'Mật khẩu cũ không chính xác!']);
        }

        DB::table('khachhang')->where('MaKhachHang', $maKhachHang)->update([
            'MatKhau' => $request->MatKhauMoi 
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}