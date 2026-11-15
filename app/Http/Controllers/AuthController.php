<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('client.auth.login');
    }

    // 1. ĐĂNG NHẬP (Đã tích hợp phân quyền chuyển hướng Admin và ràng buộc chức vụ nhân viên)
    public function login(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required',
            'MatKhau' => 'required'
        ], [
            'TenDangNhap.required' => 'Vui lòng nhập Tên đăng nhập!',
            'MatKhau.required' => 'Vui lòng nhập mật khẩu!'
        ]);

        // Tìm tài khoản theo TenDangNhap
        $taiKhoan = TaiKhoan::where('TenDangNhap', $request->TenDangNhap)->first();

        if (!$taiKhoan) {
            return back()->withErrors(['TenDangNhap' => 'Tên đăng nhập không tồn tại!'])->withInput();
        }

        // Kiểm tra trạng thái hoạt động (TrangThaiHoatDong == 1 mới được đăng nhập)
        if ($taiKhoan->TrangThaiHoatDong != 1) {
            return back()->withErrors(['TenDangNhap' => 'Tài khoản của bạn đã bị khóa hoặc chưa kích hoạt!']);
        }

        // So sánh mật khẩu an toàn (Hỗ trợ cả chuỗi thô lẫn Hash, tránh lỗi thuật toán Bcrypt)
        $isPasswordValid = false;
        if ($taiKhoan->MatKhau === $request->MatKhau) {
            $isPasswordValid = true;
        } else {
            try {
                if (Hash::check($request->MatKhau, $taiKhoan->MatKhau)) {
                    $isPasswordValid = true;
                }
            } catch (\Exception $e) {
                $isPasswordValid = false;
            }
        }

        if (!$isPasswordValid) {
            return back()->withErrors(['TenDangNhap' => 'Mật khẩu không chính xác!'])->withInput();
        }

        // Cập nhật thời gian đăng nhập cuối
        $taiKhoan->update(['LanDangNhapCuoi' => now()]);

        // --- PHÂN QUYỀN VÀ RÀNG BUỘC TRANG QUẢN TRỊ ---
        // Kiểm tra nếu tài khoản thuộc nhóm quản trị (Ví dụ VT002 hoặc VT003 theo hệ thống cũ của bạn)
        $nhomQuanTriVaNhanVien = ['VT002', 'VT003']; 

        if (in_array($taiKhoan->MaVaiTro, $nhomQuanTriVaNhanVien)) {
            // RÀNG BUỘC BẮT BUỘC: Phải tồn tại trong bảng nhanvien và đúng chức vụ
            $nhanVien = DB::table('nhanvien')
                ->where('MaTaiKhoan', $taiKhoan->MaTaiKhoan)
                ->first();

            if (!$nhanVien) {
                return back()->withErrors(['TenDangNhap' => 'Truy cập bị từ chối! Tài khoản này không thuộc danh sách nhân sự quản trị.'])->withInput();
            }

            // Chỉ cho phép đúng "Nhân viên tư vấn" hoặc "Quản lý Studio"
            $chucVuHopLe = ['Nhân viên tư vấn', 'Quản lý Studio'];
            if (!in_array(trim($nhanVien->ChucVu), $chucVuHopLe)) {
                return back()->withErrors(['TenDangNhap' => 'Bạn không có quyền truy cập hệ thống quản trị (Chỉ dành cho Nhân viên tư vấn và Quản lý Studio)!'])->withInput();
            }

            // Lưu session quản trị
            Session::put('taikhoan', $taiKhoan);
            Session::put('nhanvienSession', $nhanVien);

            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập trang quản trị thành công!');
        }

        // Nếu là tài khoản Khách hàng thông thường (VT001 hoặc các vai trò khác)
        $khachHang = KhachHang::where('MaTaiKhoan', $taiKhoan->MaTaiKhoan)->first();

        Session::put('khachhang', $khachHang);
        Session::put('taikhoan', $taiKhoan);

        return redirect()->route('client.home')->with('success', 'Đăng nhập thành công!');
    }

    public function showRegister()
    {
        return view('client.auth.register');
    }

    // 2. ĐĂNG KÝ
    public function register(Request $request)
    {
        $request->validate([
            'HoTen' => 'required|string|max:100',
            'TenDangNhap' => 'required|string|max:100|unique:taikhoan,TenDangNhap',
            'Email' => 'required|email|unique:khachhang,Email',
            'SoDienThoai' => 'required|numeric',
            'MatKhau' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
        ], [
            'HoTen.required' => 'Vui lòng nhập họ và tên!',
            'TenDangNhap.required' => 'Vui lòng nhập Tên đăng nhập!',
            'TenDangNhap.unique' => 'Tên đăng nhập này đã được sử dụng!',
            'Email.required' => 'Vui lòng nhập Email!',
            'Email.email' => 'Email không đúng định dạng!',
            'Email.unique' => 'Email này đã được đăng ký tài khoản!',
            'SoDienThoai.required' => 'Vui lòng nhập số điện thoại!',
            'SoDienThoai.numeric' => 'Số điện thoại chỉ được nhập số!',
            'MatKhau.required' => 'Vui lòng nhập mật khẩu!',
            'MatKhau.confirmed' => 'Xác nhận mật khẩu không khớp!',
            'MatKhau.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự!',
            'MatKhau' => 'Mật khẩu phải từ 8 ký tự trở lên và bao gồm cả chữ in hoa, chữ thường, chữ số cùng ký tự đặc biệt (!@#$%...)'
        ]);

        DB::beginTransaction();
        try {
            $nextTKId = 'TK' . str_pad((TaiKhoan::count() + 1), 3, '0', STR_PAD_LEFT);
            $nextKHId = 'KH' . str_pad((KhachHang::count() + 1), 3, '0', STR_PAD_LEFT);

            $taiKhoan = TaiKhoan::create([
                'MaTaiKhoan' => $nextTKId,
                'TenDangNhap' => $request->TenDangNhap,
                'MatKhau' => $request->MatKhau,
                'TrangThaiHoatDong' => 1,
                'NgayTao' => now(),
                'LanDangNhapCuoi' => now(),
                'MaVaiTro' => 'VT001' // Khách hàng mới đăng ký mặc định là VT001
            ]);
            
            $khachHang = KhachHang::create([
                'MaKhachHang' => $nextKHId,
                'HoTen' => $request->HoTen,
                'Email' => $request->Email,
                'SoDienThoai' => $request->SoDienThoai,
                'NgaySinh' => $request->NgaySinh,
                'GioiTinh' => $request->GioiTinh ?? 'Nữ',
                'DiaChi' => $request->DiaChi,
                'TrangThai' => 1,
                'MaTaiKhoan' => $nextTKId
            ]);

            DB::commit();

            Session::put('khachhang', $khachHang);
            Session::put('taikhoan', $taiKhoan);

            return redirect()->route('client.home')->with('success', 'Đăng ký tài khoản thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['TenDangNhap' => 'Có lỗi xảy ra khi tạo tài khoản: ' . $e->getMessage()])->withInput();
        }
    }

    public function logout()
    {
        Session::forget('khachhang');
        Session::forget('taikhoan');
        Session::forget('nhanvienSession');
        return redirect()->route('client.login')->with('success', 'Đã đăng xuất tài khoản!');
    }

    // Giữ lại hàm postLogin để tương thích ngược nếu route của bạn đang trỏ tới postLogin
    public function postLogin(Request $request)
    {
        return $this->login($request);
    }
}