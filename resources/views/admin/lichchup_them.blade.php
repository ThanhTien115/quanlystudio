@extends('admin.layouts.master')

@section('title', 'Thêm Lịch Chụp - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-plus text-teal-600 mr-2"></i> Thêm Mới Lịch Chụp Ảnh
        </h2>

        <form action="{{ route('admin.lichchup.store') }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            
            <div>
                <label class="block font-bold text-gray-700 mb-1">Mã Lịch Chụp</label>
                <input type="text" name="MaLichChup" value="{{ old('MaLichChup') }}" placeholder="VD: LC060" class="w-full p-2.5 border {{ $errors->has('MaLichChup') ? 'border-rose-500' : 'border-gray-200' }} rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                
                <!-- Hiển thị thông báo lỗi nếu mã bị trùng -->
                @error('MaLichChup')
                    <p class="text-rose-600 text-xs mt-1 font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Chụp:</label>
                    <input type="date" name="NgayChup" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="Còn trống">Còn trống </option>
                        <option value="Đã đặt">Đã đặt </option>
                        <option value="Tạm khóa">Tạm khóa </option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Mã Lịch Làm Việc:</label>
                    <input type="text" name="MaLichLamViec" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="VD: LLV001">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Mã Khung Giờ:</label>
                    <input type="text" name="MaKhungGio" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="VD: KG001">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Ghi Chú:</label>
                <textarea name="GhiChu" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập ghi chú..."></textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.lichchup.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Lưu Lịch Chụp</button>
            </div>
        </form>
    </div>
@endsection