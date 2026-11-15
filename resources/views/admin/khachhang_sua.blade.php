@extends('admin.layouts.master')

@section('title', 'Sửa Khách Hàng - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Hồ Sơ Khách Hàng: #{{ $khachHang->MaKhachHang }}
        </h2>

        <form action="{{ route('admin.khachhang.update', $khachHang->MaKhachHang) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Họ Và Tên:</label>
                    <input type="text" name="HoTen" value="{{ $khachHang->HoTen }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Số Điện Thoại:</label>
                    <input type="text" name="SoDienThoai" value="{{ $khachHang->SoDienThoai }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Email:</label>
                    <input type="email" name="Email" value="{{ $khachHang->Email }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Giới Tính:</label>
                    <select name="GioiTinh" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="Nam" {{ $khachHang->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $khachHang->GioiTinh == 'Nữ' || $khachHang->GioiTinh == 'Nu' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Sinh:</label>
                    <input type="date" name="NgaySinh" value="{{ $khachHang->NgaySinh }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái Tài Khoản:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="1" {{ $khachHang->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $khachHang->TrangThai == 0 ? 'selected' : '' }}>Khóa</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Địa Chỉ:</label>
                <input type="text" name="DiaChi" value="{{ $khachHang->DiaChi }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.khachhang.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật Hồ Sơ</button>
            </div>
        </form>
    </div>
@endsection