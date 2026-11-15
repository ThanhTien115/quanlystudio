@extends('admin.layouts.master')

@section('title', 'Thêm Lịch Làm Việc - 22fotoholicstudio')

@section('content')
    <div class="max-w-3xl mx-auto">
        <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
            <div>
                <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                    <i class="fa-solid fa-calendar-days text-teal-600 mr-2"></i> THÊM LỊCH LÀM VIỆC MỚI
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Khai báo thông tin ca và ngày làm việc mới</p>
            </div>
            <a href="{{ route('admin.lichlamviec.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Quay lại
            </a>
        </header>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            @if ($errors->any())
                <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-xs font-bold">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.lichlamviec.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Mã Lịch Làm Việc</label>
                    <input type="text" name="MaLichLamViec" placeholder="VD: LLV001" value="{{ old('MaLichLamViec') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Ngày Làm Việc</label>
                    <input type="date" name="NgayLamViec" value="{{ old('NgayLamViec') }}" class="w-full p-2.5 border @error('NgayLamViec') border-rose-500 bg-rose-50/30 @else border-gray-200 bg-white @enderror rounded-xl focus:outline-none focus:border-teal-500 font-normal transition" required>
                    @error('NgayLamViec')
                        <p class="text-rose-600 text-[11px] font-bold mt-1.5 flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Loại Ngày</label>
                    <input type="text" name="LoaiNgay" placeholder="VD: Ngày thường / Cuối tuần / Ngày lễ" value="{{ old('LoaiNgay') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Giờ Mở Cửa</label>
                        <input type="time" name="GioMoCua" value="{{ old('GioMoCua', '08:00') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Giờ Đóng Cửa</label>
                        <input type="time" name="GioDongCua" value="{{ old('GioDongCua', '20:00') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Trạng Thái Làm Việc</label>
                    <select name="TrangThaiLamViec" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white cursor-pointer">
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm khóa</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-1">Ghi Chú</label>
                    <textarea name="GhiChu" rows="3" placeholder="Nhập ghi chú..." class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white">{{ old('GhiChu') }}</textarea>
                </div>

                <div class="pt-4 flex space-x-2">
                    <button type="submit" class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                        Lưu Lịch Làm Việc
                    </button>
                    <a href="{{ route('admin.lichlamviec.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition">
                        Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection