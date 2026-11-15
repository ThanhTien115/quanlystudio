@extends('admin.layouts.master')

@section('title', 'Thêm Add-on - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-plus text-teal-600 mr-2"></i> Thêm Mới Dịch Vụ Đi Kèm (`dichvudikem`)
        </h2>

        <form action="{{ route('admin.dichvudikem.store') }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            
            <div>
                <label class="block text-gray-700 mb-1">Mã Add-on (VD: DVDK016):</label>
                <input type="text" name="MaDichVuDiKem" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal uppercase" placeholder="Nhập mã add-on...">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Tên Dịch Vụ Đi Kèm:</label>
                <input type="text" name="TenDichVuDiKem" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập tên add-on...">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Đơn Giá (VNĐ):</label>
                    <input type="number" step="1000" name="DonGia" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="VD: 150000">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Đơn Vị Tính (VD: bộ, lần, tấm):</label>
                    <input type="text" name="DonViTinh" value="bộ" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm ẩn</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Mô Tả:</label>
                <textarea name="MoTa" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập mô tả..."></textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.dichvu.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Lưu Add-on</button>
            </div>
        </form>
    </div>
@endsection