@extends('layouts.client')

@section('title', 'Đổi Mật Khẩu - 22fotoholicstudio')

@section('content')
<style>
    body {
        background-color: #f8f0fd !important; /* Màu xanh lá nhạt tươi mới, đồng bộ với trang hồ sơ */
    }
</style>

<div class="max-w-md mx-auto pt-36 pb-12 px-4 text-gray-800">
    @if(session('success'))
        <div class="mb-4 bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-xl text-xs font-bold shadow-sm">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-xs space-y-1 font-bold">
            @foreach ($errors->all() as $error)
                <div><i class="fa-solid fa-triangle-exclamation mr-1.5"></i> {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b border-gray-100 pb-4 gap-3">
            <h1 class="text-base font-black uppercase text-gray-900 flex items-center">
                <i class="fa-solid fa-key text-teal-600 mr-2 text-base"></i> Đổi Mật Khẩu
            </h1>
            
            <!-- Nhóm nút điều hướng -->
            <div class="flex items-center space-x-2">
                <!-- Nút Quay về trang chủ -->
                <a href="{{ route('client.home') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-3 py-2 rounded-xl transition flex items-center shadow-sm">
                    <i class="fa-solid fa-house mr-1 text-teal-600"></i> Trang Chủ
                </a>
                
                <!-- Nút Quay lại hồ sơ -->
                <a href="{{ route('client.hosocanhan') }}" class="text-xs bg-green-50 hover:bg-green-100 text-green-700 font-bold px-3 py-2 rounded-xl transition flex items-center shadow-sm">
                    Hồ Sơ
                </a>
            </div>
        </div>

        <form action="{{ route('client.doimatkhau.store') }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf

            <div>
                <label class="block text-gray-700 mb-1">Mật Khẩu Cũ:</label>
                <input type="password" name="MatKhauCu" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white text-gray-900" placeholder="Nhập mật khẩu cũ...">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Mật Khẩu Mới:</label>
                <input type="password" name="MatKhauMoi" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white text-gray-900" placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)...">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Xác Nhận Mật Khẩu Mới:</label>
                <input type="password" name="MatKhauMoi_confirmation" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white text-gray-900" placeholder="Nhập lại mật khẩu mới...">
            </div>

            <div class="pt-4 border-t border-gray-100">
                <button type="submit" class="w-full py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                    Cập Nhật Mật Khẩu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection