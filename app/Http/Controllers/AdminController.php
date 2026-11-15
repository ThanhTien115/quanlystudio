<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $tongLichChup = DB::table('lichchup')->count();
        $tongKhachHang = DB::table('khachhang')->count();
        $tongHoaDon = DB::table('hoadon')->count();
        $doanhThu = DB::table('hoadon')->where('TrangThai', 'Đã thanh toán')->sum('SoTienDaThanhToan');
        
        $danhSachDatLichMoi = DB::table('datlich')
            ->join('khachhang', 'datlich.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->leftJoin('dichvu', 'datlich.MaDichVu', '=', 'dichvu.MaDichVu')
            ->select('datlich.*', 'khachhang.HoTen', 'khachhang.SoDienThoai', 'dichvu.TenDichVu')
            ->orderBy('datlich.NgayDat', 'desc')
            ->limit(5)
            ->get();

        $nhanVienSession = session('nhanvien');
        $tenVaiTro = $nhanVienSession->ChucVu ?? 'Quản trị viên'; 

        return view('admin.dashboard', compact(
            'tongLichChup', 
            'tongKhachHang', 
            'tongHoaDon', 
            'doanhThu', 
            'danhSachDatLichMoi',
            'nhanVienSession',
            'tenVaiTro'
        ));
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required',
            'MatKhau' => 'required',
        ]);

        $taiKhoan = DB::table('taikhoan')
            ->where('TenDangNhap', $request->TenDangNhap)
            ->first();

        if (!$taiKhoan || $taiKhoan->MatKhau !== $request->MatKhau) {
            return back()->withErrors(['error' => 'Tên đăng nhập hoặc mật khẩu không chính xác!'])->withInput();
        }

        $nhanVien = DB::table('nhanvien')
            ->where('MaTaiKhoan', $taiKhoan->MaTaiKhoan)
            ->first();

        if (!$nhanVien) {
            return back()->withErrors(['error' => 'Truy cập bị từ chối! Tài khoản này không thuộc danh sách nhân sự quản trị.'])->withInput();
        }

        $chucVuHopLe = ['Nhân viên tư vấn', 'Quản lý Studio'];
        
        if (!in_array(trim($nhanVien->ChucVu), $chucVuHopLe)) {
            return back()->withErrors(['error' => 'Bạn không có quyền truy cập hệ thống quản trị (Chỉ dành cho Nhân viên tư vấn và Quản lý Studio)!'])->withInput();
        }

        session([
            'taikhoan' => $taiKhoan,
            'nhanvienSession' => $nhanVien 
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
    }

    public function dashboard()
    {
        $nhanVien = session('taikhoan');
        $tongDatLich = DB::table('datlich')->count();
        $tongKhachHang = DB::table('khachhang')->count();
        $tongHoaDon = DB::table('hoadon')->count();
        $doanhThu = DB::table('thanhtoan')->where('TrangThai', 'Thành công')->sum('SoTien');

        return view('admin.dashboard', compact('nhanVien', 'tongDatLich', 'tongKhachHang', 'tongHoaDon', 'doanhThu'));
    }


    public function quanLyDatLich(Request $request)
    {
        $query = DB::table('datlich')
            ->leftJoin('khachhang', 'datlich.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->leftJoin('dichvu', 'datlich.MaDichVu', '=', 'dichvu.MaDichVu')
            ->leftJoin('lichchup', 'datlich.MaLichChup', '=', 'lichchup.MaLichChup')
            ->select(
                'datlich.*', 
                'khachhang.HoTen as TenKhachHang', 
                'khachhang.SoDienThoai', 
                'dichvu.TenDichVu',
                'lichchup.NgayChup'
            );

        // Lọc theo từ khóa tìm kiếm
        if ($request->filled('tu_khoa')) {
            $search = $request->tu_khoa;
            $query->where(function($q) use ($search) {
                $q->where('datlich.MaDatLich', 'like', "%{$search}%")
                  ->orWhere('khachhang.HoTen', 'like', "%{$search}%")
                  ->orWhere('khachhang.SoDienThoai', 'like', "%{$search}%");
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('datlich.TrangThai', $request->trang_thai);
        }

        // THÊM: Lọc theo ngày chụp cụ thể
        if ($request->filled('ngay_chup')) {
            $query->whereDate('lichchup.NgayChup', $request->ngay_chup);
        }

        $danhSachDatLich = $query->orderBy('datlich.NgayDat', 'desc')->paginate(7)->withQueryString();

        // Thống kê số lượng các trạng thái giữ nguyên...
        $tongSoDon = DB::table('datlich')->count();
        $soChoThanhToan = DB::table('datlich')->where('TrangThai', 'Chờ thanh toán')->count();
        $soDaXacNhan = DB::table('datlich')->where('TrangThai', 'Đã xác nhận')->count();
        $soDoiLich = DB::table('datlich')->where('TrangThai', 'Đang yêu cầu đổi lịch')->count();
        $soChapNhanDoi = DB::table('datlich')->where('TrangThai', 'Chấp nhận đổi lịch')->count();
        $soYeuCauHuy = DB::table('datlich')->where('TrangThai', 'Đang yêu cầu hủy')->count();
        $soDaHuy = DB::table('datlich')->where('TrangThai', 'Đã hủy')->count();
        $soHoanThanh = DB::table('datlich')->where('TrangThai', 'Đã hoàn thành')->count();

        return view('admin.datlich', compact(
            'danhSachDatLich', 
            'tongSoDon', 
            'soChoThanhToan', 
            'soDaXacNhan', 
            'soDoiLich', 
            'soChapNhanDoi', 
            'soYeuCauHuy', 
            'soDaHuy', 
            'soHoanThanh'
        ));
    }

    public function thongKeLichDat(Request $request)
    {
        $query = DB::table('datlich')
            ->leftJoin('lichchup', 'datlich.MaLichChup', '=', 'lichchup.MaLichChup');

        // 1. Lọc theo ngày cụ thể
        if ($request->filled('ngay_cu_the')) {
            $query->whereDate('lichchup.NgayChup', $request->ngay_cu_the);
        }

        // 2. Lọc theo tháng (Định dạng YYYY-MM)
        if ($request->filled('thang_cu_the')) {
            $thang = $request->thang_cu_the; // ví dụ: '2026-11'
            $query->whereYear('lichchup.NgayChup', '=', date('Y', strtotime($thang)))
                  ->whereMonth('lichchup.NgayChup', '=', date('m', strtotime($thang)));
        }

        // 3. Lọc theo khoảng thời gian tùy chọn (Từ ngày ... Đến ngày ...)
        if ($request->filled('tu_ngay') && $request->filled('den_ngay')) {
            $query->whereBetween('lichchup.NgayChup', [$request->tu_ngay, $request->den_ngay]);
        }

        // Tổng số lịch đặt theo bộ lọc
        $tongSoLichDat = $query->count();

        // Thống kê chi tiết theo từng trạng thái trong khoảng thời gian đó
        $thongKeTrangThai = (clone $query)
            ->select('datlich.TrangThai', DB::raw('count(*) as SoLuong'))
            ->groupBy('datlich.TrangThai')
            ->pluck('SoLuong', 'TrangThai');

        // Lấy danh sách chi tiết các đơn trong khoảng thời gian lọc
        $danhSachDon = $query
            ->leftJoin('khachhang', 'datlich.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->leftJoin('dichvu', 'datlich.MaDichVu', '=', 'dichvu.MaDichVu')
            ->select('datlich.*', 'khachhang.HoTen as TenKhachHang', 'khachhang.SoDienThoai', 'dichvu.TenDichVu', 'lichchup.NgayChup')
            ->orderBy('lichchup.NgayChup', 'desc')
            ->paginate(10)
            ->appends($request->all());

        $nhanVien = session('taikhoan');

        return view('admin.thongkelichdat', compact(
            'tongSoLichDat', 
            'thongKeTrangThai', 
            'danhSachDon', 
            'nhanVien'
        ));
    }
    // Hiển thị form sửa đơn đặt lịch
    public function formSuaDatLich($id)
    {
        $datLich = DB::table('datlich')->where('MaDatLich', $id)->first();
        $danhSachKhachHang = DB::table('khachhang')->get();
        $danhSachDichVu = DB::table('dichvu')->get();
        $nhanVien = session('taikhoan');

        return view('admin.datlich_sua', compact('datLich', 'danhSachKhachHang', 'danhSachDichVu', 'nhanVien'));
    }

    // Xử lý cập nhật đơn đặt lịch
    public function capNhatDatLich(Request $request, $id)
    {
        DB::table('datlich')->where('MaDatLich', $id)->update([
            'MaKhachHang' => $request->MaKhachHang,
            'MaDichVu' => $request->MaDichVu,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.datlich.index')->with('success', 'Cập nhật đơn đặt lịch thành công!');
    }

    public function xoaDatLich(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // 1. Lấy danh sách mã hóa đơn liên quan để xóa thanh toán trước
            $hoaDons = DB::table('hoadon')->where('MaDatLich', $id)->pluck('MaHoaDon');
            
            if ($hoaDons->isNotEmpty()) {
                $maThanhToans = DB::table('thanhtoan')->whereIn('MaHoaDon', $hoaDons)->pluck('MaThanhToan');
                if ($maThanhToans->isNotEmpty()) {
                    if (DB::getSchemaBuilder()->hasTable('lichsuthanhtoan')) {
                        DB::table('lichsuthanhtoan')->whereIn('MaThanhToan', $maThanhToans)->delete();
                    }
                    DB::table('thanhtoan')->whereIn('MaHoaDon', $hoaDons)->delete();
                }
                DB::table('hoadon')->where('MaDatLich', $id)->delete();
            }

            // 2. Xóa chi tiết dịch vụ đi kèm
            if (DB::getSchemaBuilder()->hasTable('chitietdichvudikem')) {
                DB::table('chitietdichvudikem')->where('MaDatLich', $id)->delete();
            }

            // 3. Xóa lịch sử đặt lịch
            if (DB::getSchemaBuilder()->hasTable('lichsudatlich')) {
                DB::table('lichsudatlich')->where('MaDatLich', $id)->delete();
            }

            // 4. Xóa thông báo liên quan
            if (DB::getSchemaBuilder()->hasTable('thongbao')) {
                DB::table('thongbao')->where('MaDatLich', $id)->delete();
            }

            // 5. Cuối cùng tiến hành xóa đơn đặt lịch
            DB::table('datlich')->where('MaDatLich', $id)->delete();

            DB::commit();

            // Sử dụng redirect()->back() để giữ nguyên trang hiện tại (kèm theo page phân trang và bộ lọc)
            return back()->with('success', 'Đã xóa đơn đặt lịch #' . $id . ' và dữ liệu liên quan thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Không thể xóa đơn đặt lịch này do vướng ràng buộc dữ liệu: ' . $e->getMessage()]);
        }
    }

    // --- QUẢN LÝ KHUNG GIỜ & CA LÀM VIỆC ---
    public function quanLyKhungGio(Request $request)
    {
        $danhSachKhungGio = DB::table('khunggio')->orderBy('GioBatDau', 'asc')->paginate(7);
        return view('admin.khunggio', compact('danhSachKhungGio'));
    }

    public function themKhungGio()
    {
        return view('admin.khunggio_them');
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

    // Hiển thị form sửa khung giờ
    public function formSuaKhungGio($id)
    {
        $khungGio = DB::table('khunggio')->where('MaKhungGio', $id)->first();
        $nhanVien = session('taikhoan');
        return view('admin.khunggio_sua', compact('khungGio', 'nhanVien'));
    }

    // Xử lý cập nhật khung giờ vào CSDL
    public function capNhatKhungGio(Request $request, $id)
    {
        $request->validate([
            'GioBatDau' => 'required',
            'GioKetThuc' => 'required',
            'TrangThai' => 'required',
        ]);

        DB::table('khunggio')->where('MaKhungGio', $id)->update([
            'GioBatDau' => $request->GioBatDau,
            'GioKetThuc' => $request->GioKetThuc,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.khunggio.index')->with('success', 'Cập nhật khung giờ thành công!');
    }

    public function xoaKhungGio($id)
    {
        DB::table('khunggio')->where('MaKhungGio', $id)->delete();
        return back()->with('success', 'Đã xóa khung giờ thành công!');
    }


    public function quanLyLichLamViec(Request $request)
    {
        $query = DB::table('lichlamviec');

        if ($request->filled('tu_khoa')) {
            $tuKhoa = trim($request->tu_khoa);
            $query->where('MaLichLamViec', 'like', '%' . $tuKhoa . '%');
        }

        if ($request->filled('trang_thai')) {
            $query->where('TrangThaiLamViec', $request->trang_thai);
        }

        $danhSachLichLamViec = $query->orderBy('MaLichLamViec', 'desc')->paginate(7)->appends($request->all());
        $nhanVien = session('taikhoan');

        return view('admin.lichlamviec', compact('danhSachLichLamViec', 'nhanVien'));
    }

    public function formThemLichLamViec()
    {
        $nhanVien = session('taikhoan');
        return view('admin.lichlamviec_them', compact('nhanVien'));
    }

    public function luuLichLamViec(Request $request)
    {
        $request->validate([
            'MaLichLamViec' => 'required|unique:lichlamviec,MaLichLamViec',
            'NgayLamViec' => 'required|date',
            'GioMoCua' => 'required',
            'GioDongCua' => 'required',
        ]);

        // Kiểm tra xem ngày làm việc đã tồn tại trong hệ thống chưa
        $kiemTraTrungNgay = DB::table('lichlamviec')->where('NgayLamViec', $request->NgayLamViec)->exists();

        if ($kiemTraTrungNgay) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['NgayLamViec' => 'Ngày làm việc ' . date('d/m/Y', strtotime($request->NgayLamViec)) . ' đã có lịch làm việc trong hệ thống. Vui lòng chọn ngày khác!']);
        }

        DB::table('lichlamviec')->insert([
            'MaLichLamViec'    => $request->MaLichLamViec,
            'NgayLamViec'      => $request->NgayLamViec,
            'LoaiNgay'         => $request->LoaiNgay,
            'GioMoCua'         => $request->GioMoCua,
            'GioDongCua'       => $request->GioDongCua,
            'TrangThaiLamViec' => $request->TrangThaiLamViec ?? 1,
            'GhiChu'           => $request->GhiChu,
        ]);

        return redirect()->route('admin.lichlamviec.index')->with('success', 'Thêm lịch làm việc thành công!');
    
    }

    public function formSuaLichLamViec($id)
    {
        $lichLamViec = DB::table('lichlamviec')->where('MaLichLamViec', $id)->first();
        $nhanVien = session('taikhoan');
        return view('admin.lichlamviec_sua', compact('lichLamViec', 'nhanVien'));
    }

    public function capNhatLichLamViec(Request $request, $id)
    {
        DB::table('lichlamviec')->where('MaLichLamViec', $id)->update([
            'NgayLamViec'      => $request->NgayLamViec,
            'LoaiNgay'         => $request->LoaiNgay,
            'GioMoCua'         => $request->GioMoCua,
            'GioDongCua'       => $request->GioDongCua,
            'TrangThaiLamViec' => $request->TrangThaiLamViec,
            'GhiChu'           => $request->GhiChu,
        ]);

        return redirect()->route('admin.lichlamviec.index')->with('success', 'Cập nhật lịch làm việc thành công!');
    }

    public function xoaLichLamViec($id)
    {
        DB::table('lichlamviec')->where('MaLichLamViec', $id)->delete();
        return redirect()->route('admin.lichlamviec.index')->with('success', 'Xóa lịch làm việc thành công!');
    }

    
    public function quanLyLichChup(Request $request)
    {
        $query = DB::table('lichchup');

        // 1. Tìm kiếm theo Mã lịch chụp
        if ($request->filled('tu_khoa')) {
            $tuKhoa = trim($request->tu_khoa);
            $query->where('MaLichChup', 'like', '%' . $tuKhoa . '%');
        }

        // 2. Lọc theo trạng thái (Đã đặt, Còn trống, Tạm khóa...)
        if ($request->filled('trang_thai')) {
            $query->where('TrangThai', $request->trang_thai);
        }

        // 3. Lọc theo ngày chụp cụ thể
        if ($request->filled('ngay_chup')) {
            $query->whereDate('NgayChup', $request->ngay_chup);
        }

        // Phân trang 7 bản ghi và giữ lại các tham số trên URL
        $danhSachLichChup = $query->orderBy('MaLichChup', 'desc')->paginate(7)->appends($request->all());
        $nhanVien = session('taikhoan');

        return view('admin.lichchup', compact('danhSachLichChup', 'nhanVien'));
    }

    // 1. Hiển thị form Thêm lịch chụp
    public function themLichChup()
    {
        $nhanVien = session('taikhoan');
        return view('admin.lichchup_them', compact('nhanVien'));
    }

    // 2. Lưu lịch chụp mới vào CSDL
    public function luuLichChup(Request $request)
    {
        // 1. Kiểm tra xem Mã lịch chụp đã tồn tại trong cơ sở dữ liệu chưa
        $kiemTraTrung = DB::table('lichchup')->where('MaLichChup', $request->MaLichChup)->exists();

        if ($kiemTraTrung) {
            // Nếu trùng, quay lại form kèm theo thông báo lỗi và giữ nguyên dữ liệu cũ
            return redirect()->back()
                ->withInput()
                ->withErrors(['MaLichChup' => 'Mã lịch chụp này đã tồn tại trong hệ thống. Vui lòng nhập mã khác!']);
        }

        // 2. Nếu chưa trùng, tiến hành lưu vào CSDL
        DB::table('lichchup')->insert([
            'MaLichChup'   => $request->MaLichChup,
            'NgayChup'     => $request->NgayChup,
            'TrangThai'    => $request->TrangThai,
            'GhiChu'       => $request->GhiChu,
            'MaLichLamViec'=> $request->MaLichLamViec,
            'MaKhungGio'   => $request->MaKhungGio,
        ]);

        return redirect()->route('admin.lichchup.index')->with('success', 'Thêm lịch chụp thành công!');
    }

    // 3. Hiển thị form Sửa lịch chụp
    public function suaLichChup($id)
    {
        $lichChup = DB::table('lichchup')->where('MaLichChup', $id)->first();
        $nhanVien = session('taikhoan');

        return view('admin.lichchup_sua', compact('lichChup', 'nhanVien'));
    }

    // 4. Cập nhật lịch chụp vào CSDL
    public function capNhatLichChup(Request $request, $id)
    {
        DB::table('lichchup')->where('MaLichChup', $id)->update([
            'TrangThai' => $request->TrangThai,
            'GhiChu' => $request->GhiChu,
            'MaLichLamViec' => $request->MaLichLamViec,
            'MaKhungGio' => $request->MaKhungGio,
        ]);

        return redirect()->route('admin.lichchup.index')->with('success', 'Cập nhật lịch chụp thành công!');
    }

    public function xoaLichChup($id)
    {
        DB::table('lichchup')->where('MaLichChup', $id)->delete();

        return redirect()->route('admin.lichchup.index')->with('success', 'Xóa lịch chụp thành công!');
    }

    // ==========================================
    // QUẢN LÝ DANH MỤC CONCEPT CHÍNH
    // ==========================================

    // 1. Hiển thị danh sách concept (Phân trang 7 bản ghi/trang)
    // Quản lý tổng hợp Concept Chính & Chi Tiết Concept trên 1 trang
    public function quanLyConcept(Request $request)
    {
        // 1. Xử lý cho danh sách Concept Chính
        $queryConcept = DB::table('concept');
        if ($request->filled('tu_khoa_concept')) {
            $tuKhoa = trim($request->tu_khoa_concept);
            $queryConcept->where(function($q) use ($tuKhoa) {
                $q->where('MaConcept', 'like', '%' . $tuKhoa . '%')
                  ->orWhere('TenConcept', 'like', '%' . $tuKhoa . '%');
            });
        }
        if ($request->filled('trang_thai_concept')) {
            $queryConcept->where('TrangThai', $request->trang_thai_concept);
        }
        $danhSachConcept = $queryConcept->orderBy('MaConcept', 'desc')->paginate(7, ['*'], 'page_cpt')->appends($request->all());

        // 2. Xử lý cho danh sách Chi Tiết Concept
        $queryChiTiet = DB::table('chitietconcept')
            ->leftJoin('concept', 'chitietconcept.MaConcept', '=', 'concept.MaConcept')
            ->select('chitietconcept.*', 'concept.TenConcept');

        if ($request->filled('tu_khoa_chitiet')) {
            $tuKhoaCT = trim($request->tu_khoa_chitiet);
            $queryChiTiet->where(function($q) use ($tuKhoaCT) {
                $q->where('chitietconcept.MaChiTietConcept', 'like', '%' . $tuKhoaCT . '%')
                  ->orWhere('chitietconcept.TenChiTietConcept', 'like', '%' . $tuKhoaCT . '%');
            });
        }
        if ($request->filled('trang_thai_chitiet')) {
            $queryChiTiet->where('chitietconcept.TrangThai', $request->trang_thai_chitiet);
        }
        $danhSachChiTietConcept = $queryChiTiet->orderBy('chitietconcept.MaChiTietConcept', 'desc')->paginate(7, ['*'], 'page_ct')->appends($request->all());

        $nhanVien = session('taikhoan');

        return view('admin.concept', compact('danhSachConcept', 'danhSachChiTietConcept', 'nhanVien'));
    }

    // 2. Hiển thị form thêm danh mục concept
    public function formThemConcept()
    {
        $nhanVien = session('taikhoan');
        return view('admin.concept_them', compact('nhanVien'));
    }

    // 3. Lưu danh mục concept mới vào CSDL
    public function luuConcept(Request $request)
    {
        DB::table('concept')->insert([
            'MaConcept' => $request->MaConcept,
            'TenConcept' => $request->TenConcept,
            'MoTa' => $request->MoTa,
            'TrangThai' => $request->TrangThai ?? 1,
        ]);

        return redirect()->route('admin.concept.index')->with('success', 'Thêm danh mục concept thành công!');
    }

    // 4. Hiển thị form sửa danh mục concept
    public function formSuaConcept($id)
    {
        $concept = DB::table('concept')->where('MaConcept', $id)->first();
        $nhanVien = session('taikhoan');

        return view('admin.concept_sua', compact('concept', 'nhanVien'));
    }

    // 5. Cập nhật danh mục concept vào CSDL
    public function capNhatConcept(Request $request, $id)
    {
        DB::table('concept')->where('MaConcept', $id)->update([
            'TenConcept' => $request->TenConcept,
            'MoTa' => $request->MoTa,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.concept.index')->with('success', 'Cập nhật danh mục concept thành công!');
    }

    // 6. Xóa danh mục concept khỏi CSDL
    public function xoaConcept($id)
    {
        DB::table('concept')->where('MaConcept', $id)->delete();

        return redirect()->route('admin.concept.index')->with('success', 'Xóa danh mục concept thành công!');
    }

    // Hàm phụ trợ để tương thích với các route cũ trỏ tới chi tiết concept
    public function quanLyChiTietConcept(Request $request)
    {
        return $this->quanLyConcept($request);
    }

    public function formThemChiTietConcept()
    {
        $danhSachConcept = DB::table('concept')->get();
        $nhanVien = session('taikhoan');
        return view('admin.chitietconcept_them', compact('danhSachConcept', 'nhanVien'));
    }

    public function luuChiTietConcept(Request $request)
    {
        DB::table('chitietconcept')->insert([
            'MaChiTietConcept' => $request->MaChiTietConcept,
            'TenChiTietConcept' => $request->TenChiTietConcept,
            'MaConcept' => $request->MaConcept,
            'MoTa' => $request->MoTa,
            'HinhAnh' => $request->HinhAnh,
            'TrangThai' => $request->TrangThai ?? 1,
        ]);
        return redirect()->back()->with('success', 'Thêm chi tiết concept thành công!');
    }

    public function formSuaChiTietConcept($id)
    {
        $chiTiet = DB::table('chitietconcept')->where('MaChiTietConcept', $id)->first();
        $danhSachConcept = DB::table('concept')->get();
        $nhanVien = session('taikhoan');
        return view('admin.chitietconcept_sua', compact('chiTiet', 'danhSachConcept', 'nhanVien'));
    }

    public function capNhatChiTietConcept(Request $request, $id)
    {
        DB::table('chitietconcept')->where('MaChiTietConcept', $id)->update([
            'TenChiTietConcept' => $request->TenChiTietConcept,
            'MaConcept' => $request->MaConcept,
            'MoTa' => $request->MoTa,
            'HinhAnh' => $request->HinhAnh,
            'TrangThai' => $request->TrangThai,
        ]);
        return redirect()->route('admin.chitietconcept.index')->with('success', 'Cập nhật thành công!');
    }

    public function xoaChiTietConcept($id)
    {
        DB::table('chitietconcept')->where('MaChiTietConcept', $id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }


    // Quản lý chung Gói Dịch Vụ & Add-ons
    public function quanLyDichVu(Request $request)
    {
        // 1. Xử lý cho danh sách dịch vụ chính (nếu có form riêng hoặc dùng chung)
        $danhSachDichVu = DB::table('dichvu')->orderBy('MaDichVu', 'desc')->paginate(8, ['*'], 'page_dv');

        // 2. Xử lý tìm kiếm và lọc cho danh sách dịch vụ đi kèm (Add-ons)
        $queryAddOns = DB::table('dichvudikem');

        if ($request->filled('tu_khoa_addons')) {
            $tuKhoa = trim($request->tu_khoa_addons);
            $queryAddOns->where(function($q) use ($tuKhoa) {
                $q->where('MaDichVuDiKem', 'like', '%' . $tuKhoa . '%')
                ->orWhere('TenDichVuDiKem', 'like', '%' . $tuKhoa . '%');
            });
        }

        if ($request->filled('trang_thai_addons')) {
            $queryAddOns->where('TrangThai', $request->trang_thai_addons);
        }

        $danhSachAddOns = $queryAddOns->orderBy('MaDichVuDiKem', 'desc')->paginate(8, ['*'], 'page_addon')->appends($request->all());

        $nhanVien = session('taikhoan');

        return view('admin.dichvu', compact('danhSachDichVu', 'danhSachAddOns', 'nhanVien'));
    }

    // --- XỬ LÝ DỊCH VỤ CHÍNH (dichvu) ---
    public function formThemDichVu()
    {
        $nhanVien = session('taikhoan');
        return view('admin.dichvu_them', compact('nhanVien'));
    }

    public function luuDichVu(Request $request)
    {
        DB::table('dichvu')->insert([
            'MaDichVu' => $request->MaDichVu,
            'TenDichVu' => $request->TenDichVu,
            'MoTa' => $request->MoTa,
            'DonGia' => $request->DonGia,
            'ThoiLuongDuKien' => $request->ThoiLuongDuKien ?? 270,
            'SoNguoiToiDa' => $request->SoNguoiToiDa ?? 1,
            'TrangThai' => $request->TrangThai ?? 1,
        ]);
        return redirect()->route('admin.dichvu.index')->with('success', 'Thêm gói dịch vụ thành công!');
    }

    public function formSuaDichVu($id)
    {
        $dichVu = DB::table('dichvu')->where('MaDichVu', $id)->first();
        $nhanVien = session('taikhoan');
        return view('admin.dichvu_sua', compact('dichVu', 'nhanVien'));
    }

    public function capNhatDichVu(Request $request, $id)
    {
        DB::table('dichvu')->where('MaDichVu', $id)->update([
            'TenDichVu' => $request->TenDichVu,
            'MoTa' => $request->MoTa,
            'DonGia' => $request->DonGia,
            'TrangThai' => $request->TrangThai,
        ]);
        return redirect()->route('admin.dichvu.index')->with('success', 'Cập nhật dịch vụ thành công!');
    }

    public function xoaDichVu($id)
    {
        DB::table('dichvu')->where('MaDichVu', $id)->delete();
        return redirect()->route('admin.dichvu.index')->with('success', 'Xóa dịch vụ thành công!');
    }

    // --- XỬ LÝ DỊCH VỤ DI KÈM / ADD-ONS (dichvudikem) ---
    public function quanLyDichVuDiKem(Request $request)
    {
        $query = DB::table('dichvudikem');

        // 1. Tìm kiếm theo từ khóa (Mã Add-on hoặc Tên dịch vụ đi kèm)
        if ($request->filled('tu_khoa')) {
            $tuKhoa = trim($request->tu_khoa);
            $query->where(function($q) use ($tuKhoa) {
                $q->where('MaDvDiKem', 'like', '%' . $tuKhoa . '%')
                ->orWhere('TenDvDiKem', 'like', '%' . $tuKhoa . '%');
            });
        }

        // 2. Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('TrangThai', $request->trang_thai);
        }

        // Phân trang 8 bản ghi và giữ lại các tham số trên URL
        $danhSachAddOns = $query->orderBy('MaDichVuDiKem', 'desc')->paginate(8)->appends($request->all());
        $nhanVien = session('taikhoan');

        return view('admin.dichvudikem', compact('danhSachAddOns', 'nhanVien'));
    }

    public function formThemDichVuDiKem()
    {
        $nhanVien = session('taikhoan');
        return view('admin.dichvudikem_them', compact('nhanVien'));
    }

    public function luuDichVuDiKem(Request $request)
    {
        DB::table('dichvudikem')->insert([
            'MaDichVuDiKem' => $request->MaDichVuDiKem,
            'TenDichVuDiKem' => $request->TenDichVuDiKem,
            'MoTa' => $request->MoTa,
            'DonGia' => $request->DonGia,
            'DonViTinh' => $request->DonViTinh ?? 'bộ',
            'TrangThai' => $request->TrangThai ?? 1,
        ]);
        return redirect()->route('admin.dichvu.index')->with('success', 'Thêm add-on thành công!');
    }

    public function formSuaDichVuDiKem($id)
    {
        $addon = DB::table('dichvudikem')->where('MaDichVuDiKem', $id)->first();
        $nhanVien = session('taikhoan');
        return view('admin.dichvudikem_sua', compact('addon', 'nhanVien'));
    }

    public function capNhatDichVuDiKem(Request $request, $id)
    {
        DB::table('dichvudikem')->where('MaDichVuDiKem', $id)->update([
            'TenDichVuDiKem' => $request->TenDichVuDiKem,
            'MoTa' => $request->MoTa,
            'DonGia' => $request->DonGia,
            'DonViTinh' => $request->DonViTinh,
            'TrangThai' => $request->TrangThai,
        ]);
        return redirect()->route('admin.dichvu.index')->with('success', 'Cập nhật add-on thành công!');
    }

    public function xoaDichVuDiKem($id)
    {
        DB::table('dichvudikem')->where('MaDichVuDiKem', $id)->delete();
        return redirect()->route('admin.dichvu.index')->with('success', 'Xóa add-on thành công!');
    }

   // Quản lý danh sách voucher (Phân trang 6 bản ghi/trang)
    public function quanLyVoucher(Request $request)
    {
        $query = DB::table('voucher');

        // 1. Tìm kiếm theo từ khóa (Mã voucher, Mã code hoặc Tên voucher)
        if ($request->filled('tu_khoa')) {
            $tuKhoa = trim($request->tu_khoa);
            $query->where(function($q) use ($tuKhoa) {
                $q->where('MaVoucher', 'like', '%' . $tuKhoa . '%')
                ->orWhere('MaCode', 'like', '%' . $tuKhoa . '%')
                ->orWhere('TenVoucher', 'like', '%' . $tuKhoa . '%');
            });
        }

        // 2. Lọc theo loại giảm giá (Chỉ lọc khi có chọn giá trị cụ thể)
        if ($request->filled('loai_giam_gia')) {
            $query->where('LoaiGiamGia', $request->loai_giam_gia);
        }

        // 3. Lọc theo trạng thái (Chỉ lọc khi có chọn giá trị cụ thể)
        if ($request->filled('trang_thai')) {
            $query->where('TrangThai', $request->trang_thai);
        }

        // Phân trang 6 bản ghi và giữ lại toàn bộ tham số tìm kiếm/lọc trên URL
        $danhSachVoucher = $query->orderBy('MaVoucher', 'desc')->paginate(6)->appends($request->all());
        $nhanVien = session('taikhoan');

        return view('admin.voucher', compact('danhSachVoucher', 'nhanVien'));
    }

    public function formThemVoucher()
    {
        $nhanVien = session('taikhoan');
        return view('admin.voucher_them', compact('nhanVien'));
    }

    public function luuVoucher(Request $request)
    {
        DB::table('voucher')->insert([
            'MaVoucher' => $request->MaVoucher,
            'TenVoucher' => $request->TenVoucher,
            'MaCode' => $request->MaCode,
            'LoaiGiamGia' => $request->LoaiGiamGia,
            'GiaTriGiam' => $request->GiaTriGiam,
            'GiamToiDa' => $request->GiamToiDa,
            'DonToiThieu' => $request->DonToiThieu,
            'NgayBatDau' => $request->NgayBatDau,
            'NgayKetThuc' => $request->NgayKetThuc,
            'SoLuotSuDungToiDa' => $request->SoLuotSuDungToiDa ?? 100,
            'SoLuotDaSuDung' => 0,
            'TrangThai' => $request->TrangThai ?? 1,
        ]);
        return redirect()->route('admin.voucher.index')->with('success', 'Thêm voucher thành công!');
    }

    public function formSuaVoucher($id)
    {
        $voucher = DB::table('voucher')->where('MaVoucher', $id)->first();
        $nhanVien = session('taikhoan');
        return view('admin.voucher_sua', compact('voucher', 'nhanVien'));
    }

    public function capNhatVoucher(Request $request, $id)
    {
        DB::table('voucher')->where('MaVoucher', $id)->update([
            'TenVoucher' => $request->TenVoucher,
            'MaCode' => $request->MaCode,
            'LoaiGiamGia' => $request->LoaiGiamGia,
            'GiaTriGiam' => $request->GiaTriGiam,
            'GiamToiDa' => $request->GiamToiDa,
            'DonToiThieu' => $request->DonToiThieu,
            'NgayBatDau' => $request->NgayBatDau,
            'NgayKetThuc' => $request->NgayKetThuc,
            'TrangThai' => $request->TrangThai,
        ]);
        return redirect()->route('admin.voucher.index')->with('success', 'Cập nhật voucher thành công!');
    }

    public function xoaVoucher($id)
    {
        DB::table('voucher')->where('MaVoucher', $id)->delete();
        return redirect()->route('admin.voucher.index')->with('success', 'Xóa voucher thành công!');
    }

    
    public function quanLyHoaDon(Request $request)
    {
        $query = DB::table('hoadon')
            ->leftJoin('khachhang', 'hoadon.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->select('hoadon.*', 'khachhang.HoTen as TenKhachHang', 'khachhang.SoDienThoai');

        // 1. Tìm kiếm theo từ khóa (Mã hóa đơn hoặc Tên khách hàng)
        if ($request->has('tu_khoa') && !empty(trim($request->tu_khoa))) {
            $tuKhoa = trim($request->tu_khoa);
            $query->where(function($q) use ($tuKhoa) {
                $q->where('hoadon.MaHoaDon', 'like', '%' . $tuKhoa . '%')
                ->orWhere('khachhang.HoTen', 'like', '%' . $tuKhoa . '%');
            });
        }

        // 2. Lọc theo trạng thái hóa đơn
        if ($request->has('trang_thai') && !empty($request->trang_thai)) {
            $query->where('hoadon.TrangThai', $request->trang_thai);
        }

        $danhSachHoaDon = $query->orderBy('hoadon.NgayLap', 'desc')->paginate(6)->appends($request->all());
        $nhanVien = session('taikhoan');

        return view('admin.hoadon', compact('danhSachHoaDon', 'nhanVien'));
    }

    public function luuHoaDon(Request $request)
    {
        DB::table('hoadon')->insert([
            'MaHoaDon' => $request->MaHoaDon,
            'TongTien' => $request->TongTien,
            'SoTienGiam' => $request->SoTienGiam ?? 0,
            'TienCoc' => $request->TienCoc ?? 0,
            'TongTienPhaiTra' => $request->TongTienPhaiTra ?? 0,
            'SoTienDaThanhToan' => $request->SoTienDaThanhToan ?? 0,
            'SoTienConLai' => ($request->TongTien - ($request->SoTienGiam ?? 0)) - ($request->SoTienDaThanhToan ?? 0),
            'TrangThai' => $request->TrangThai ?? 'Chờ thanh toán',
            'NgayLap' => now(),
            'NgayCapNhat' => now(),
            'MaDatLich' => $request->MaDatLich,
            'MaKhachHang' => $request->MaKhachHang,
            'MaVoucher' => $request->MaVoucher,
        ]);
        return redirect()->route('admin.hoadon.index')->with('success', 'Thêm hóa đơn thành công!');
    }

    public function formSuaHoaDon($id)
    {
        $hoaDon = DB::table('hoadon')->where('MaHoaDon', $id)->first();
        $danhSachKhachHang = DB::table('khachhang')->get();
        $danhSachVoucher = DB::table('voucher')->get();
        $nhanVien = session('taikhoan');
        return view('admin.hoadon_sua', compact('hoaDon', 'danhSachKhachHang', 'danhSachVoucher', 'nhanVien'));
    }

    public function capNhatHoaDon(Request $request, $id)
    {
        $tongTienPhaiTra = $request->TongTien - $request->SoTienGiam;
        $conLai = $tongTienPhaiTra - $request->SoTienDaThanhToan;

        DB::table('hoadon')->where('MaHoaDon', $id)->update([
            'TongTien' => $request->TongTien,
            'SoTienGiam' => $request->SoTienGiam,
            'TienCoc' => $request->TienCoc,
            'TongTienPhaiTra' => $tongTienPhaiTra,
            'SoTienDaThanhToan' => $request->SoTienDaThanhToan,
            'SoTienConLai' => $conLai > 0 ? $conLai : 0,
            'TrangThai' => $request->TrangThai,
            'NgayCapNhat' => now(),
            'MaDatLich' => $request->MaDatLich,
            'MaKhachHang' => $request->MaKhachHang,
            'MaVoucher' => $request->MaVoucher,
        ]);
        return redirect()->route('admin.hoadon.index')->with('success', 'Cập nhật hóa đơn thành công!');
    }

    public function xoaHoaDon($id)
    {
        // Xóa các bản ghi thanh toán liên quan trước (để tránh lỗi khóa ngoại)
        DB::table('thanhtoan')->where('MaHoaDon', $id)->delete();

        // Sau đó tiến hành xóa hóa đơn
        DB::table('hoadon')->where('MaHoaDon', $id)->delete();

        return redirect()->route('admin.hoadon.index')->with('success', 'Xóa hóa đơn thành công!');
    }

    // 1. Quản lý danh sách khách hàng
    public function quanLyKhachHang(Request $request)
    {
        $query = DB::table('khachhang');

        // 1. Tìm kiếm theo từ khóa (Mã khách hàng hoặc Họ tên)
        if ($request->filled('tu_khoa')) {
            $tuKhoa = trim($request->tu_khoa);
            $query->where(function($q) use ($tuKhoa) {
                $q->where('MaKhachHang', 'like', '%' . $tuKhoa . '%')
                ->orWhere('HoTen', 'like', '%' . $tuKhoa . '%');
            });
        }

        // 2. Lọc theo trạng thái (Chỉ lọc khi người dùng chọn 0 hoặc 1, bỏ qua nếu để trống '')
        if ($request->filled('trang_thai')) {
            $query->where('TrangThai', $request->trang_thai);
        }

        // Phân trang 8 bản ghi và giữ lại tham số trên URL
        $danhSachKhachHang = $query->orderBy('MaKhachHang', 'desc')->paginate(7)->appends($request->all());
        
        $nhanVien = session('taikhoan');
        return view('admin.khachhang', compact('danhSachKhachHang', 'nhanVien'));
    }
    
    // 1. Form sửa khách hàng 
    public function formSuaKhachHang($id)
    {
        $khachHang = DB::table('khachhang')->where('MaKhachHang', $id)->first();
        $nhanVien = session('taikhoan');
        return view('admin.khachhang_sua', compact('khachHang', 'nhanVien'));
    }

    // 2. Cập nhật thông tin khách hàng thuần túy
    public function capNhatKhachHang(Request $request, $id)
    {
        DB::table('khachhang')->where('MaKhachHang', $id)->update([
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'SoDienThoai' => $request->SoDienThoai,
            'Email' => $request->Email,
            'DiaChi' => $request->DiaChi,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.khachhang.index')->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    // 3. Xem danh sách lịch sử đặt lịch của khách hàng
    public function lichSuDatLichKhachHang($id)
    {
        $khachHang = DB::table('khachhang')->where('MaKhachHang', $id)->first();
        
        $danhSachLichSu = DB::table('lichsudatlich')
            ->join('datlich', 'lichsudatlich.MaDatLich', '=', 'datlich.MaDatLich')
            ->where('datlich.MaKhachHang', $id)
            ->select('lichsudatlich.*', 'datlich.MaDatLich')
            ->orderBy('lichsudatlich.ThoiGianThaoTac', 'desc')
            ->paginate(7);

        $nhanVien = session('taikhoan');
        return view('admin.khachhang_lichsu', compact('khachHang', 'danhSachLichSu', 'nhanVien'));
    }

    // 4. Form sửa lịch sử đặt lịch (Cập nhật Lý do & Ghi chú riêng biệt)
    public function formSuaLichSuDatLich($id)
    {
        $lichSu = DB::table('lichsudatlich')->where('MaLichSuDatLich', $id)->first();
        
        // Lấy thông tin khách hàng để hiển thị nút quay lại đúng trang lịch sử của khách đó
        $datLich = DB::table('datlich')->where('MaDatLich', $lichSu->MaDatLich)->first();
        $maKhachHang = $datLich ? $datLich->MaKhachHang : null;

        $nhanVien = session('taikhoan');
        return view('admin.lichsudatlich_sua', compact('lichSu', 'maKhachHang', 'nhanVien'));
    }

    // 5. Lưu cập nhật lịch sử đặt lịch
    public function capNhatLichSuDatLich(Request $request, $id)
    {
        $lichSu = DB::table('lichsudatlich')->where('MaLichSuDatLich', $id)->first();
        $datLich = DB::table('datlich')->where('MaDatLich', $lichSu->MaDatLich)->first();

        DB::table('lichsudatlich')->where('MaLichSuDatLich', $id)->update([
            'LyDo' => $request->LyDo,
            'GhiChu' => $request->GhiChu,
            'ThoiGianThaoTac' => now(),
        ]);

        return redirect()->route('admin.khachhang.lichsu', $datLich->MaKhachHang)->with('success', 'Cập nhật lý do và ghi chú thành công!');
    }

    // 6. Xóa dòng lịch sử đặt lịch
    public function xoaLichSuDatLich($id)
    {
        $lichSu = DB::table('lichsudatlich')->where('MaLichSuDatLich', $id)->first();
        $datLich = DB::table('datlich')->where('MaDatLich', $lichSu->MaDatLich)->first();
        $maKhachHang = $datLich ? $datLich->MaKhachHang : null;

        DB::table('lichsudatlich')->where('MaLichSuDatLich', $id)->delete();

        return redirect()->route('admin.khachhang.lichsu', $maKhachHang)->with('success', 'Xóa lịch sử thành công!');
    }

    /**
     * Hiển thị danh sách các yêu cầu đặt lịch cần xử lý (Đang yêu cầu đổi / Đang yêu cầu hủy)
     */
    public function bookingRequests()
    {
        $danhSachYeuCau = DB::table('datlich')
            ->leftJoin('dichvu', 'datlich.MaDichVu', '=', 'dichvu.MaDichVu')
            ->leftJoin('khachhang', 'datlich.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->whereIn('datlich.TrangThai', ['Đang yêu cầu đổi lịch', 'Đang yêu cầu hủy'])
            ->select('datlich.*', 'dichvu.TenDichVu', 'khachhang.HoTen as TenKhachHang', 'khachhang.SoDienThoai')
            ->orderBy('datlich.NgayCapNhat', 'desc')
            ->get();

        return view('admin.booking_requests', compact('danhSachYeuCau'));
    }

    /**
     * Xử lý duyệt hoặc từ chối yêu cầu đổi/hủy lịch của khách
     */
    public function processBookingRequest(Request $request, $id)
    {
        $request->validate([
            'HanhDong' => 'required|in:DuyetDoi,TuChoiDoi,DuyetHuy,TuChoiHuy'
        ]);

        $datLich = DB::table('datlich')->where('MaDatLich', $id)->first();
        if (!$datLich) {
            return back()->withErrors(['error' => 'Không tìm thấy đơn đặt lịch!']);
        }

        DB::beginTransaction();
        try {
            $trangThaiMoi = $datLich->TrangThai;
            $hanhDongLog = '';
            $ghiChuLog = '';

            if ($request->HanhDong == 'DuyetDoi') {
                $trangThaiMoi = 'Đã xác nhận';
                $hanhDongLog = 'Duyệt đổi lịch';
                $ghiChuLog = 'Admin đã duyệt yêu cầu thay đổi lịch của khách hàng.';
            } elseif ($request->HanhDong == 'TuChoiDoi') {
                $trangThaiMoi = 'Đã xác nhận'; // Giữ lại lịch cũ
                $hanhDongLog = 'Từ chối đổi lịch';
                $ghiChuLog = 'Admin từ chối yêu cầu đổi lịch, giữ nguyên lịch cũ.';
            } elseif ($request->HanhDong == 'DuyetHuy') {
                $trangThaiMoi = 'Đã hủy';
                $hanhDongLog = 'Duyệt hủy lịch';
                $ghiChuLog = 'Admin đã duyệt yêu cầu hủy lịch.';
            } elseif ($request->HanhDong == 'TuChoiHuy') {
                $trangThaiMoi = 'Đã xác nhận';
                $hanhDongLog = 'Từ chối hủy lịch';
                $ghiChuLog = 'Admin từ chối yêu cầu hủy lịch của khách.';
            }

            // Cập nhật trạng thái bảng datlich
            DB::table('datlich')->where('MaDatLich', $id)->update([
                'TrangThai' => $trangThaiMoi,
                'NgayCapNhat' => now()
            ]);

            // Ghi log lịch sử
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
                    'TrangThaiMoi' => $trangThaiMoi,
                    'ThoiGianThaoTac' => now(),
                    'HanhDong' => $hanhDongLog,
                    'LyDo' => $request->GhiChuPhanHoi ?? null,
                    'GhiChu' => $ghiChuLog,
                    'MaDatLich' => $id
                ]);
            }

            DB::commit();
            return back()->with('success', 'Đã xử lý yêu cầu đặt lịch thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}
