@extends('admin.layouts.master')

@section('title', 'Thêm Voucher - 22fotoholicstudio')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-2xl mx-auto space-y-6">
        <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
            <i class="fa-solid fa-plus text-teal-600 mr-2"></i> Thêm Mới Voucher & Mã Giảm Giá
        </h2>

        <form action="{{ route('admin.voucher.store') }}" method="POST" class="space-y-4 text-xs font-bold">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Mã Voucher (VD: VC016):</label>
                    <input type="text" name="MaVoucher" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal uppercase" placeholder="Nhập mã voucher...">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Mã Code (VD: SUMMER2026):</label>
                    <input type="text" name="MaCode" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal uppercase" placeholder="Nhập mã code...">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Tên Chương Trình Voucher:</label>
                <input type="text" name="TenVoucher" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập tên voucher...">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Loại Giảm Giá:</label>
                    <select name="LoaiGiamGia" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="PhanTram">Phần trăm (%)</option>
                        <option value="SoTien">Số tiền (VNĐ)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Giá Trị Giảm (VD: 10 hoặc 200000):</label>
                    <input type="number" step="0.01" name="GiaTriGiam" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Nhập giá trị giảm...">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Giảm Tối Đa (VNĐ):</label>
                    <input type="number" step="1000" name="GiamToiDa" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="Bỏ trống nếu không giới hạn">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Đơn Tối Thiểu (VNĐ):</label>
                    <input type="number" step="1000" name="DonToiThieu" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal" placeholder="VD: 1000000">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Bắt Đầu:</label>
                    <input type="date" name="NgayBatDau" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Ngày Kết Thúc:</label>
                    <input type="date" name="NgayKetThuc" required class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Số Lượt Sử Dụng Tối Đa:</label>
                    <input type="number" name="SoLuotSuDungToiDa" value="100" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Trạng Thái:</label>
                    <select name="TrangThai" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm ẩn</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.voucher.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Hủy</a>
                <button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-sm">Lưu Voucher</button>
            </div>
        </form>
    </div>
@endsection