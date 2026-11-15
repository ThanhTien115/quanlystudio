@extends('admin.layouts.master')

@section('title', 'Sửa Lịch Chụp - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Lịch Chụp: #{{ $lichChup->MaLichChup }}
        </h2>

        <form action="{{ route('admin.lichchup.update', $lichChup->MaLichChup) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Chụp:</label>
                    <input type="date" name="NgayChup" value="{{ $lichChup->NgayChup }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái (Trọng điểm):</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal text-teal-700 font-bold">
                        <option value="Còn trống" {{ $lichChup->TrangThai == 'Còn trống' ? 'selected' : '' }}>Còn trống </option>
                        <option value="Đã đặt" {{ $lichChup->TrangThai == 'Đã đặt' ? 'selected' : '' }}>Đã đặt </option>
                        <option value="Tạm khóa" {{ $lichChup->TrangThai == 'Tạm khóa' ? 'selected' : '' }}>Tạm khóa </option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Mã Lịch Làm Việc:</label>
                    <input type="text" name="MaLichLamViec" value="{{ $lichChup->MaLichLamViec }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Mã Khung Giờ:</label>
                    <input type="text" name="MaKhungGio" value="{{ $lichChup->MaKhungGio }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Ghi Chú:</label>
                <textarea name="GhiChu" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">{{ $lichChup->GhiChu }}</textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.lichchup.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật Lịch Chụp</button>
            </div>
        </form>
    </div>
@endsection