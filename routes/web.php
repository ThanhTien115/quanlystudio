<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// 1. Auth Routes (Màn hình Đăng nhập & Đăng ký)
Route::get('/login', [AuthController::class, 'showLogin'])->name('client.login');
Route::post('/login', [AuthController::class, 'login'])->name('client.login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('client.register');
Route::post('/register', [AuthController::class, 'register'])->name('client.register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('client.logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/admin/dat-lich', [AdminController::class, 'quanLyDatLich'])->name('datlich.index');
    Route::get('/admin/dat-lich/sua/{id}', [AdminController::class, 'formSuaDatLich'])->name('datlich.edit');
    Route::put('/admin/dat-lich/sua/{id}', [AdminController::class, 'capNhatDatLich'])->name('datlich.update');
    Route::delete('/admin/dat-lich/xoa/{id}', [AdminController::class, 'xoaDatLich'])->name('datlich.destroy');
    Route::get('/thong-ke-lich-dat', [AdminController::class, 'thongKeLichDat'])->name('thongke.lichdat');

    Route::get('/booking-requests', [AdminController::class, 'bookingRequests'])->name('booking.requests');
    Route::post('/booking-requests/{id}/process', [AdminController::class, 'processBookingRequest'])->name('booking.processRequest');

    // Các route quản lý tiếp theo
    Route::get('/lich-chup', [AdminController::class, 'quanLyLichChup'])->name('lichchup.index');
    // Thêm lịch chụp
    Route::get('/lich-chup/them', [AdminController::class, 'themLichChup'])->name('lichchup.them');
    Route::post('/lich-chup/them', [AdminController::class, 'luuLichChup'])->name('lichchup.store');

    // Sửa lịch chụp (Thay đổi trạng thái)
    Route::get('/lich-chup/sua/{id}', [AdminController::class, 'suaLichChup'])->name('lichchup.edit');
    Route::put('/lich-chup/sua/{id}', [AdminController::class, 'capNhatLichChup'])->name('lichchup.update');

    // Xóa lịch chụp
    Route::delete('/lich-chup/xoa/{id}', [AdminController::class, 'xoaLichChup'])->name('lichchup.destroy');

    // Quản lý Concept chính
    Route::get('/concept', [AdminController::class, 'quanLyConcept'])->name('concept.index');
    Route::get('/concept/them', [AdminController::class, 'formThemConcept'])->name('concept.create');
    Route::post('/concept/them', [AdminController::class, 'luuConcept'])->name('concept.store');
    Route::get('/concept/sua/{id}', [AdminController::class, 'formSuaConcept'])->name('concept.edit');
    Route::put('/concept/sua/{id}', [AdminController::class, 'capNhatConcept'])->name('concept.update');
    Route::delete('/concept/xoa/{id}', [AdminController::class, 'xoaConcept'])->name('concept.destroy');

    // Xem chi tiết concept theo MaConcept
    Route::get('/concept/chi-tiet/{maConcept}', [AdminController::class, 'xemChiTietTheoConcept'])->name('concept.chitiet');

    // Quản lý Chi tiết Concept chung
    Route::get('/chi-tiet-concept', [AdminController::class, 'quanLyChiTietConcept'])->name('chitietconcept.index');
    Route::get('/chi-tiet-concept/them', [AdminController::class, 'formThemChiTietConcept'])->name('chitietconcept.create');
    Route::post('/chi-tiet-concept/them', [AdminController::class, 'luuChiTietConcept'])->name('chitietconcept.store');
    Route::get('/chi-tiet-concept/sua/{id}', [AdminController::class, 'formSuaChiTietConcept'])->name('chitietconcept.edit');
    Route::put('/chi-tiet-concept/sua/{id}', [AdminController::class, 'capNhatChiTietConcept'])->name('chitietconcept.update');
    Route::delete('/chi-tiet-concept/xoa/{id}', [AdminController::class, 'xoaChiTietConcept'])->name('chitietconcept.destroy');


   // Quản lý Dịch vụ chính (dichvu)
    Route::get('/dich-vu', [AdminController::class, 'quanLyDichVu'])->name('dichvu.index');
    Route::get('/dich-vu/them', [AdminController::class, 'formThemDichVu'])->name('dichvu.create');
    Route::post('/dich-vu/them', [AdminController::class, 'luuDichVu'])->name('dichvu.store');
    Route::get('/dich-vu/sua/{id}', [AdminController::class, 'formSuaDichVu'])->name('dichvu.edit');
    Route::put('/dich-vu/sua/{id}', [AdminController::class, 'capNhatDichVu'])->name('dichvu.update');
    Route::delete('/dich-vu/xoa/{id}', [AdminController::class, 'xoaDichVu'])->name('dichvu.destroy');

    // Quản lý Dịch vụ đi kèm / Add-ons (dichvudikem)
    Route::get('/dich-vu-di-kem', [AdminController::class, 'quanLyDichVuDiKem'])->name('dichvudikem.index');
    Route::get('/dich-vu-di-kem/them', [AdminController::class, 'formThemDichVuDiKem'])->name('dichvudikem.create');
    Route::post('/dich-vu-di-kem/them', [AdminController::class, 'luuDichVuDiKem'])->name('dichvudikem.store');
    Route::get('/dich-vu-di-kem/sua/{id}', [AdminController::class, 'formSuaDichVuDiKem'])->name('dichvudikem.edit');
    Route::put('/dich-vu-di-kem/sua/{id}', [AdminController::class, 'capNhatDichVuDiKem'])->name('dichvudikem.update');
    Route::delete('/dich-vu-di-kem/xoa/{id}', [AdminController::class, 'xoaDichVuDiKem'])->name('dichvudikem.destroy');

    
    Route::get('/voucher', [AdminController::class, 'quanLyVoucher'])->name('voucher.index');
    Route::get('/voucher/them', [AdminController::class, 'formThemVoucher'])->name('voucher.create');
    Route::post('/voucher/them', [AdminController::class, 'luuVoucher'])->name('voucher.store');
    Route::get('/voucher/sua/{id}', [AdminController::class, 'formSuaVoucher'])->name('voucher.edit');
    Route::put('/voucher/sua/{id}', [AdminController::class, 'capNhatVoucher'])->name('voucher.update');
    Route::delete('/voucher/xoa/{id}', [AdminController::class, 'xoaVoucher'])->name('voucher.destroy');

    Route::get('/hoa-don', [AdminController::class, 'quanLyHoaDon'])->name('hoadon.index');
    Route::post('/hoa-don/them', [AdminController::class, 'luuHoaDon'])->name('hoadon.store');
    Route::get('/hoa-don/sua/{id}', [AdminController::class, 'formSuaHoaDon'])->name('hoadon.edit');
    Route::put('/hoa-don/sua/{id}', [AdminController::class, 'capNhatHoaDon'])->name('hoadon.update');
    Route::delete('/hoa-don/xoa/{id}', [AdminController::class, 'xoaHoaDon'])->name('hoadon.destroy');


    // Khách hàng & Lịch sử đặt lịch
    Route::get('/khach-hang', [AdminController::class, 'quanLyKhachHang'])->name('khachhang.index');
    Route::get('/khach-hang/sua/{id}', [AdminController::class, 'formSuaKhachHang'])->name('khachhang.edit');
    Route::put('/khach-hang/sua/{id}', [AdminController::class, 'capNhatKhachHang'])->name('khachhang.update');
    Route::delete('/khach-hang/xoa/{id}', [AdminController::class, 'xoaKhachHang'])->name('khachhang.destroy');
    
    // Xem, sửa, xóa lịch sử đặt lịch của khách hàng
    Route::get('/khach-hang/lich-su-dat/{id}', [AdminController::class, 'lichSuDatLichKhachHang'])->name('khachhang.lichsu');
    Route::get('/lich-su-dat-lich/sua/{id}', [AdminController::class, 'formSuaLichSuDatLich'])->name('lichsudatlich.edit');
    Route::put('/lich-su-dat-lich/sua/{id}', [AdminController::class, 'capNhatLichSuDatLich'])->name('lichsudatlich.update');
    Route::delete('/lich-su-dat-lich/xoa/{id}', [AdminController::class, 'xoaLichSuDatLich'])->name('lichsudatlich.destroy');

   
    // Quản lý khung giờ & lịch làm việc
    Route::get('/khung-gio', [AdminController::class, 'quanLyKhungGio'])->name('khunggio.index');
    Route::get('/khung-gio/them', [AdminController::class, 'themKhungGio'])->name('khunggio.them');
    Route::post('/khung-gio/luu', [AdminController::class, 'luuKhungGio'])->name('khunggio.store');
    Route::get('/khung-gio/sua/{id}', [AdminController::class, 'formSuaKhungGio'])->name('khunggio.edit');
    Route::put('/khung-gio/cap-nhat/{id}', [AdminController::class, 'capNhatKhungGio'])->name('khunggio.update');
    Route::delete('/khung-gio/xoa/{id}', [AdminController::class, 'xoaKhungGio'])->name('khunggio.destroy');


    Route::get('/lich-lam-viec', [AdminController::class, 'quanLyLichLamViec'])->name('lichlamviec.index');
    Route::get('/lich-lam-viec/them', [AdminController::class, 'formThemLichLamViec'])->name('lichlamviec.them');
    Route::post('/lich-lam-viec/luu', [AdminController::class, 'luuLichLamViec'])->name('lichlamviec.store');
    Route::get('/lich-lam-viec/sua/{id}', [AdminController::class, 'formSuaLichLamViec'])->name('lichlamviec.edit');
    Route::put('/lich-lam-viec/cap-nhat/{id}', [AdminController::class, 'capNhatLichLamViec'])->name('lichlamviec.update');
    Route::delete('/lich-lam-viec/xoa/{id}', [AdminController::class, 'xoaLichLamViec'])->name('lichlamviec.destroy');
    });

// 2. Trang chủ Studio & Xem Concept (Màn hình chính Dark Theme sau khi đăng nhập)
Route::get('/', [ClientController::class, 'home'])->name('client.home');
Route::get('/concept', [ClientController::class, 'home'])->name('client.concept');


// 3. Quy trình Đặt Lịch (Form đặt lịch, Checkout thanh toán, Lịch sử)
// Form Đặt Lịch (Chuyển sang khi nhấn nút ĐẶT LỊCH trên Trang chủ)
Route::get('/booking', [ClientController::class, 'bookingForm'])->name('client.booking.form');
Route::post('/booking/store', [ClientController::class, 'storeBooking'])->name('client.booking.store');

Route::post('/booking/{maDatLich}/request-change', [ClientController::class, 'requestChangeBooking'])->name('client.booking.requestChange');
Route::post('/booking/{maDatLich}/request-cancel', [ClientController::class, 'requestCancelBooking'])->name('client.booking.requestCancel');


// Màn hình Thanh Toán & Đặt cọc
Route::get('/checkout/{maDatLich}', [ClientController::class, 'showCheckout'])->name('client.checkout');
Route::post('/checkout/{maDatLich}', [ClientController::class, 'processCheckout'])->name('client.checkout.process');

// Route Màn hình Thông báo Thanh toán thành công
Route::get('/checkout-success/{maDatLich}', [ClientController::class, 'showCheckoutSuccess'])->name('client.checkout.success');

// Màn hình Lịch Sử Đặt Lịch
Route::get('/booking-history', [ClientController::class, 'bookingHistory'])->name('client.booking.history');

// Route test gửi email qua ClientController
Route::get('/client-test-email/{maDatLich}', [ClientController::class, 'testSendEmailNotification']);
Route::get('/api/available-timeslots', [ClientController::class, 'getAvailableTimeSlots'])->name('client.api.timeslots');

    Route::get('/tai-khoan/thong-bao', [ClientController::class, 'danhSachThongBao'])->name('client.thongbao');
    Route::post('/tai-khoan/thong-bao/danh-dau-da-doc/{id}', [ClientController::class, 'danhDauDaDoc'])->name('client.thongbao.read');
    Route::get('/tai-khoan/ho-so', [ClientController::class, 'formHoSo'])->name('client.hosocanhan');
    Route::post('/tai-khoan/ho-so/cap-nhat', [ClientController::class, 'capNhatHoSo'])->name('client.hosocanhan.update');

    // Đổi mật khẩu
    Route::get('/tai-khoan/doi-mat-khau', [ClientController::class, 'formDoiMatKhau'])->name('client.doimatkhau');
    Route::post('/tai-khoan/doi-mat-khau/xu-ly', [ClientController::class, 'xuLyDoiMatKhau'])->name('client.doimatkhau.store');

    // Trong routes/web.php
    Route::get('/tai-khoan/thong-bao', [ClientController::class, 'danhSachThongBao'])->name('client.thongbao');
    Route::post('/tai-khoan/thong-bao/danh-dau-da-doc/{id}', [ClientController::class, 'danhDauDaDoc'])->name('client.thongbao.read');
    Route::post('/tai-khoan/thong-bao/doi-trang-thai/{id}', [ClientController::class, 'doiTrangThaiThongBao'])->name('client.thongbao.toggle');