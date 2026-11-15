@extends('admin.layouts.master')

@section('title', 'Sửa Voucher - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-pen-to-square text-teal-600 mr-2"></i> Chỉnh Sửa Voucher: #{{ $voucher->MaVoucher }}
        </h2>

        <form action="{{ route('admin.voucher.update', $voucher->MaVoucher) }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Mã Code:</label>
                    <input type="text" name="MaCode" value="{{ $voucher->MaCode }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal uppercase">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Tên Chương Trình:</label>
                    <input type="text" name="TenVoucher" value="{{ $voucher->TenVoucher }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Loại Giảm Giá:</label>
                    <select name="LoaiGiamGia" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="PhanTram" {{ $voucher->LoaiGiamGia == 'PhanTram' ? 'selected' : '' }}>Phần trăm (%)</option>
                        <option value="SoTien" {{ $voucher->LoaiGiamGia == 'SoTien' ? 'selected' : '' }}>Số tiền (VNĐ)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Giá Trị Giảm:</label>
                    <input type="number" step="0.01" name="GiaTriGiam" value="{{ $voucher->GiaTriGiam }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Giảm Tối Đa (VNĐ):</label>
                    <input type="number" step="1000" name="GiamToiDa" value="{{ $voucher->GiamToiDa }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Đơn Tối Thiểu (VNĐ):</label>
                    <input type="number" step="1000" name="DonToiThieu" value="{{ $voucher->DonToiThieu }}" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Bắt Đầu:</label>
                    <input type="date" name="NgayBatDau" value="{{ $voucher->NgayBatDau }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Kết Thúc:</label>
                    <input type="date" name="NgayKetThuc" value="{{ $voucher->NgayKetThuc }}" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="1" {{ $voucher->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $voucher->TrangThai == 0 ? 'selected' : '' }}>Tạm ẩn</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.voucher.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Cập Nhật</button>
            </div>
        </form>
    </div>
@endsection