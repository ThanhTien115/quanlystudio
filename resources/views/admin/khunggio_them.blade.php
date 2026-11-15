@extends('admin.layouts.master')

@section('title', 'Thêm Khung Giờ Mới - 22fotoholicstudio')

@section('content')
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-clock text-teal-600 mr-2"></i> THÊM KHUNG GIỜ MỚI
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Thiết lập khoảng thời gian ca chụp mới cho studio</p>
        </div>
        <a href="{{ route('admin.khunggio.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition">
            <i class="fa-solid fa-arrow-left mr-1"></i> Quay lại
        </a>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 max-w-xl">
        <form action="{{ route('admin.khunggio.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf

            <div>
                <label class="block font-bold text-gray-700 mb-1">Giờ Bắt Đầu</label>
                <input type="time" name="GioBatDau" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
            </div>

            <div>
                <label class="block font-bold text-gray-700 mb-1">Giờ Kết Thúc</label>
                <input type="time" name="GioKetThuc" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white" required>
            </div>

            <div class="pt-4 flex space-x-2">
                <button type="submit" class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                    Lưu Khung Giờ
                </button>
                <a href="{{ route('admin.khunggio.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition">
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>
@endsection