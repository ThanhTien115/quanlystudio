@extends('admin.layouts.master')

@section('title', 'Sửa Lịch Làm Việc - 22fotoholicstudio')

@section('content')
    <div class="max-w-3xl mx-auto">
        <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
            <div>
                <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                    <i class="fa-solid fa-calendar-days text-teal-600 mr-2"></i> CẬP NHẬT LỊCH LÀM VIỆC: #{{ $lichLamViec->MaLichLamViec }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Chỉnh sửa thông tin ngày và ca làm việc</p>
            </div>
            <a href="{{ route('admin.lichlamviec.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Quay lại
            </a>
        </header>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <form action="{{ route('admin.lichlamviec.update', $lichLamViec->MaLichLamViec) }}" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Ngày Làm Việc</label>
                    <input type="date" name="NgayLamViec" value="{{ $lichLamViec->NgayLamViec }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Loại Ngày</label>
                    <input type="text" name="LoaiNgay" value="{{ $lichLamViec->LoaiNgay }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Giờ Mở Cửa</label>
                        <input type="time" name="GioMoCua" value="{{ $lichLamViec->GioMoCua }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Giờ Đóng Cửa</label>
                        <input type="time" name="GioDongCua" value="{{ $lichLamViec->GioDongCua }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Trạng Thái Làm Việc</label>
                    <select name="TrangThaiLamViec" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white cursor-pointer">
                        <option value="1" {{ $lichLamViec->TrangThaiLamViec == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $lichLamViec->TrangThaiLamViec == 0 ? 'selected' : '' }}>Tạm khóa</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Ghi Chú</label>
                    <textarea name="GhiChu" rows="3" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white">{{ $lichLamViec->GhiChu }}</textarea>
                </div>

                <div class="pt-4 flex space-x-2">
                    <button type="submit" class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                        Cập Nhật
                    </button>
                    <a href="{{ route('admin.lichlamviec.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition">
                        Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection