@extends('layouts.client')

@section('title', 'Hồ Sơ Cá Nhân - 22fotoholicstudio')

@section('content')
<!-- Đổi nền đen thành màu tím nhạt (#f5f3ff hoặc #ede9fe) bằng cách đổi class của body hoặc bao bọc vùng chứa -->
<style>
    body {
        background-color: #ece7ef !important; 
    }
</style>

<div class="max-w-3xl mx-auto pt-36 pb-12 px-4 text-gray-800">
    @if(session('success'))
        <div class="mb-4 bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-xl text-xs font-bold shadow-sm">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-purple-100 p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b border-gray-100 pb-4 gap-3">
            <h1 class="text-base font-black uppercase text-gray-900 flex items-center">
                <i class="fa-solid fa-user-gear text-teal-600 mr-2 text-base"></i> Quản Lý Thông Tin Cá Nhân
            </h1>
            
            <!-- Nhóm nút chức năng bên phải -->
            <div class="flex items-center space-x-2">
                <!-- Nút Quay về trang chủ -->
                <a href="{{ route('client.home') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-3.5 py-2 rounded-xl transition flex items-center shadow-sm">
                    <i class="fa-solid fa-house mr-1.5 text-teal-600"></i> Trang Chủ
                </a>
                
                <!-- Nút Đổi mật khẩu -->
                <a href="{{ route('client.doimatkhau') }}" class="text-xs bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold px-3.5 py-2 rounded-xl transition flex items-center shadow-sm">
                    <i class="fa-solid fa-key mr-1.5 text-purple-600"></i> Đổi Mật Khẩu
                </a>
            </div>
        </div>

        <form action="{{ route('client.hosocanhan.update') }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf

            <div>
                <label class="block text-gray-700 mb-1">Mã Khách Hàng</label>
                <input type="text" value="{{ $thongTin->MaKhachHang ?? '' }}" class="w-full p-3 border border-gray-200 rounded-xl bg-gray-50 font-mono text-gray-500 font-normal" disabled>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Họ và Tên</label>
                <input type="text" name="HoTen" value="{{ old('HoTen', $thongTin->HoTen ?? '') }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white text-gray-900 font-normal" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Số Điện Thoại</label>
                <input type="text" name="SoDienThoai" value="{{ old('SoDienThoai', $thongTin->SoDienThoai ?? '') }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white text-gray-900 font-normal" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="Email" value="{{ old('Email', $thongTin->Email ?? '') }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white text-gray-900 font-normal" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Địa Chỉ</label>
                <textarea name="DiaChi" rows="2" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white text-gray-900 font-normal">{{ old('DiaChi', $thongTin->DiaChi ?? '') }}</textarea>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i> Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection