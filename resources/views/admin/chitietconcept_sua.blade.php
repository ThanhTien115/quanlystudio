@extends('admin.layouts.master')

@section('title', 'Sửa Chi Tiết Concept - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Chi Tiết Concept: #{{ $chiTiet->MaChiTietConcept }}
        </h2>

        <form action="{{ route('admin.chitietconcept.update', $chiTiet->MaChiTietConcept) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Tên Concept Chi Tiết:</label>
                    <input type="text" name="TenChiTietConcept" value="{{ $chiTiet->TenChiTietConcept }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Thuộc Danh Mục Cha:</label>
                    <select name="MaConcept" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        @foreach($danhSachConcept as $c)
                            <option value="{{ $c->MaConcept }}" {{ $chiTiet->MaConcept == $c->MaConcept ? 'selected' : '' }}>
                                {{ $c->TenConcept }} (#{{ $c->MaConcept }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Tên File Ảnh:</label>
                    <input type="text" name="HinhAnh" value="{{ $chiTiet->HinhAnh }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="1" {{ $chiTiet->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $chiTiet->TrangThai == 0 ? 'selected' : '' }}>Tạm ẩn</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Mô Tả:</label>
                <textarea name="MoTa" rows="3" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">{{ $chiTiet->MoTa }}</textarea>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.chitietconcept.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật</button>
            </div>
        </form>
    </div>
@endsection