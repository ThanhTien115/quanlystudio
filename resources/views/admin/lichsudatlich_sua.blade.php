@extends('admin.layouts.master')

@section('title', 'Sửa Lịch Sử Đặt Lịch - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Lý Do & Ghi Chú: #{{ $lichSu->MaLichSuDatLich }}
        </h2>

        <form action="{{ route('admin.lichsudatlich.update', $lichSu->MaLichSuDatLich) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div class="p-4 bg-gray-50 rounded-xl space-y-1">
                <p class="text-gray-500">Mã đặt lịch liên quan: <span class="font-mono font-bold text-teal-600">#{{ $lichSu->MaDatLich }}</span></p>
                <p class="text-gray-500">Hành động hệ thống: <span class="font-bold text-purple-700">{{ $lichSu->HanhDong }}</span></p>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Lý Do:</label>
                <input type="text" name="LyDo" value="{{ $lichSu->LyDo }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập lý do...">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Ghi Chú Chi Tiết:</label>
                <textarea name="GhiChu" rows="4" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập ghi chú...">{{ $lichSu->GhiChu }}</textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.khachhang.lichsu', $maKhachHang) }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật</button>
            </div>
        </form>
    </div>
@endsection