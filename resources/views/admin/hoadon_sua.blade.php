@extends('admin.layouts.master')

@section('title', 'Sửa Hóa Đơn - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Hóa Đơn: #{{ $hoaDon->MaHoaDon }}
        </h2>

        <form action="{{ route('admin.hoadon.update', $hoaDon->MaHoaDon) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Mã Đặt Lịch:</label>
                    <input type="text" name="MaDatLich" value="{{ $hoaDon->MaDatLich }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal uppercase">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Khách Hàng:</label>
                    <select name="MaKhachHang" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        @foreach($danhSachKhachHang as $kh)
                            <option value="{{ $kh->MaKhachHang }}" {{ $hoaDon->MaKhachHang == $kh->MaKhachHang ? 'selected' : '' }}>
                                {{ $kh->HoTen }} ({{ $kh->SoDienThoai }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Voucher:</label>
                    <select name="MaVoucher" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="">-- Không dùng voucher --</option>
                        @foreach($danhSachVoucher as $vc)
                            <option value="{{ $vc->MaVoucher }}" {{ $hoaDon->MaVoucher == $vc->MaVoucher ? 'selected' : '' }}>
                                {{ $vc->TenVoucher }} ({{ $vc->MaCode }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="Chờ thanh toán" {{ $hoaDon->TrangThai == 'Chờ thanh toán' ? 'selected' : '' }}>Chờ thanh toán</option>
                        <option value="Đã đặt cọc" {{ $hoaDon->TrangThai == 'Đã đặt cọc' ? 'selected' : '' }}>Đã đặt cọc</option>
                        <option value="Đã thanh toán" {{ $hoaDon->TrangThai == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán</option>
                        <option value="Đã hủy" {{ $hoaDon->TrangThai == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Tổng Tiền (VNĐ):</label>
                    <input type="number" step="1000" name="TongTien" value="{{ $hoaDon->TongTien }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Số Tiền Giảm:</label>
                    <input type="number" step="1000" name="SoTienGiam" value="{{ $hoaDon->SoTienGiam }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Tiền Cọc:</label>
                    <input type="number" step="1000" name="TienCoc" value="{{ $hoaDon->TienCoc }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Số Tiền Đã Thanh Toán:</label>
                <input type="number" step="1000" name="SoTienDaThanhToan" value="{{ $hoaDon->SoTienDaThanhToan }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.hoadon.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật Hóa Đơn</button>
            </div>
        </form>
    </div>
@endsection