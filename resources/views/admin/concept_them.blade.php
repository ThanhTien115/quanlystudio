@extends('admin.layouts.master')

@section('title', 'Thêm Danh Mục Concept - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-plus text-teal-600 mr-2"></i> Thêm Danh Mục Concept Mới
        </h2>

        <form action="{{ route('admin.concept.store') }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            
            <div>
                <label class="block text-gray-700 mb-1">Mã Concept (VD: CPT07):</label>
                <input type="text" name="MaConcept" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal uppercase" placeholder="Nhập mã concept...">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Tên Danh Mục Concept:</label>
                <input type="text" name="TenConcept" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập tên concept...">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Mô Tả:</label>
                <textarea name="MoTa" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập mô tả chi tiết..."></textarea>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                    <option value="1">Hoạt động</option>
                    <option value="0">Tạm ẩn</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.concept.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Lưu Danh Mục</button>
            </div>
        </form>
    </div>
@endsection