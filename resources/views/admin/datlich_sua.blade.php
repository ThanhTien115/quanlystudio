@extends('admin.layouts.master')

@section('title', 'Sửa Đơn Đặt Lịch - 22fotoholicstudio')

@section('content')
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> CHỈNH SỬA ĐƠN ĐẶT LỊCH: #{{ $datLich->MaDatLich }}
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Cập nhật thông tin chi tiết cho đơn đặt lịch</p>
        </div>
        <a href="{{ route('admin.datlich.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition">
            <i class="fa-solid fa-arrow-left mr-1"></i> Quay lại
        </a>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin.datlich.update', $datLich->MaDatLich) }}" method="POST" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-bold text-gray-700 mb-1">Mã Khách Hàng</label>
                <input type="text" name="MaKhachHang" value="{{ $datLich->MaKhachHang }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <div>
                <label class="block font-bold text-gray-700 mb-1">Mã Dịch Vụ</label>
                <input type="text" name="MaDichVu" value="{{ $datLich->MaDichVu }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <div>
                <label class="block font-bold text-gray-700 mb-1">Trạng Thái Đơn</label>
                <select name="TrangThai" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal bg-white">
                    <option value="Chờ thanh toán" {{ $datLich->TrangThai == 'Chờ thanh toán' ? 'selected' : '' }}>Chờ thanh toán</option>
                    <option value="Đã xác nhận" {{ $datLich->TrangThai == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="Đang yêu cầu đổi lịch" {{ $datLich->TrangThai == 'Đang yêu cầu đổi lịch' ? 'selected' : '' }}>Đang yêu cầu đổi lịch</option>
                    <option value="Chấp nhận đổi lịch" {{ $datLich->TrangThai == 'Chấp nhận đổi lịch' ? 'selected' : '' }}>Chấp nhận đổi lịch</option>
                    <option value="Đang yêu cầu hủy" {{ $datLich->TrangThai == 'Đang yêu cầu hủy' ? 'selected' : '' }}>Đang yêu cầu hủy</option>
                    <option value="Đã hủy" {{ $datLich->TrangThai == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    <option value="Đã hoàn thành" {{ $datLich->TrangThai == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                </select>
            </div>

            <div class="pt-4 flex space-x-2">
                <button type="submit" class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                    Lưu Thay Đổi
                </button>
                <a href="{{ route('admin.datlich.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition">
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>
@endsection