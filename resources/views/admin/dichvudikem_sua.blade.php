@extends('admin.layouts.master')

@section('title', 'Sửa Add-on - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Add-on: #{{ $addon->MaDichVuDiKem }}
        </h2>

        <form action="{{ route('admin.dichvudikem.update', $addon->MaDichVuDiKem) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-gray-700 mb-1">Tên Dịch Vụ Đi Kèm:</label>
                <input type="text" name="TenDichVuDiKem" value="{{ $addon->TenDichVuDiKem }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Đơn Giá (VNĐ):</label>
                    <input type="number" step="1000" name="DonGia" value="{{ $addon->DonGia }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Đơn Vị Tính:</label>
                    <input type="text" name="DonViTinh" value="{{ $addon->DonViTinh }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="1" {{ $addon->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $addon->TrangThai == 0 ? 'selected' : '' }}>Tạm ẩn</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Mô Tả:</label>
                <textarea name="MoTa" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">{{ $addon->MoTa }}</textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.dichvu.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật</button>
            </div>
        </form>
    </div>
@endsection