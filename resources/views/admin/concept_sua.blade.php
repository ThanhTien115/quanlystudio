@extends('admin.layouts.master')

@section('title', 'Sửa Danh Mục Concept - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Danh Mục Concept: #{{ $concept->MaConcept }}
        </h2>

        <form action="{{ route('admin.concept.update', $concept->MaConcept) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-gray-700 mb-1">Tên Danh Mục Concept:</label>
                <input type="text" name="TenConcept" value="{{ $concept->TenConcept }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Mô Tả:</label>
                <textarea name="MoTa" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">{{ $concept->MoTa }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                    <option value="1" {{ $concept->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $concept->TrangThai == 0 ? 'selected' : '' }}>Tạm ẩn</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.concept.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật Danh Mục</button>
            </div>
        </form>
    </div>
@endsection