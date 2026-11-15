@extends('admin.layouts.master')

@section('title', 'Thống Kê Lịch Đặt - 22fotoholicstudio')

@section('content')
    <!-- Header tiêu đề -->
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-chart-pie text-teal-600 mr-2"></i> THỐNG KÊ TỔNG SỐ LỊCH ĐẶT
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Xem tổng số lịch đặt theo ngày, tháng hoặc khoảng thời gian tùy chọn</p>
        </div>
    </header>

    <!-- Form Bộ Lọc Thời Gian -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm mb-6">
        <form action="{{ route('admin.thongke.lichdat') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs font-bold">
            
            <!-- Lọc theo ngày cụ thể -->
            <div>
                <label class="block text-gray-700 mb-1">Theo Ngày Cụ Thể:</label>
                <input type="date" name="ngay_cu_the" value="{{ request('ngay_cu_the') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <!-- Lọc theo tháng -->
            <div>
                <label class="block text-gray-700 mb-1">Theo Tháng:</label>
                <input type="month" name="thang_cu_the" value="{{ request('thang_cu_the') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <!-- Lọc từ ngày -->
            <div>
                <label class="block text-gray-700 mb-1">Từ Ngày:</label>
                <input type="date" name="tu_ngay" value="{{ request('tu_ngay') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <!-- Lọc đến ngày -->
            <div>
                <label class="block text-gray-700 mb-1">Đến Ngày:</label>
                <input type="date" name="den_ngay" value="{{ request('den_ngay') }}" class="w-full p-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 font-normal">
            </div>

            <!-- Nút hành động -->
            <div class="sm:col-span-2 lg:col-span-4 flex justify-end space-x-2 pt-2">
                <a href="{{ route('admin.thongke.lichdat') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition">
                    Đặt Lại
                </a>
                <button type="submit" class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl transition shadow-sm cursor-pointer">
                    <i class="fa-solid fa-filter mr-1.5"></i> Lọc Thống Kê
                </button>
            </div>
        </form>
    </div>

    <!-- Thẻ Tổng Kết Kết Quả Thống Kê -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-teal-600 text-white p-6 rounded-2xl shadow-sm flex flex-col justify-between">
            <div class="text-xs uppercase font-bold tracking-wider opacity-90">Tổng Số Lịch Đặt Lọc Được</div>
            <div class="text-3xl font-black mt-2">{{ $tongSoLichDat ?? 0 }} đơn</div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm sm:col-span-3 flex flex-wrap items-center justify-around gap-2">
            <div class="text-center px-4">
                <div class="text-[11px] text-gray-500 font-bold uppercase">Đã Xác Nhận</div>
                <div class="text-xl font-black text-blue-600 mt-1">{{ $thongKeTrangThai['Đã xác nhận'] ?? 0 }}</div>
            </div>
            <div class="text-center px-4 border-l border-gray-100">
                <div class="text-[11px] text-gray-500 font-bold uppercase">Chờ Thanh Toán</div>
                <div class="text-xl font-black text-orange-500 mt-1">{{ $thongKeTrangThai['Chờ thanh toán'] ?? 0 }}</div>
            </div>
            <div class="text-center px-4 border-l border-gray-100">
                <div class="text-[11px] text-gray-500 font-bold uppercase">Hoàn Thành</div>
                <div class="text-xl font-black text-green-600 mt-1">{{ $thongKeTrangThai['Đã hoàn thành'] ?? 0 }}</div>
            </div>
            <div class="text-center px-4 border-l border-gray-100">
                <div class="text-[11px] text-gray-500 font-bold uppercase">Đã Hủy</div>
                <div class="text-xl font-black text-rose-600 mt-1">{{ $thongKeTrangThai['Đã hủy'] ?? 0 }}</div>
            </div>
        </div>
    </div>

    <!-- Bảng Danh Sách Chi Tiết Theo Khoảng Thời Gian -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Chi Tiết Các Đơn Đặt Lịch Trong Khoảng Thời Gian Đã Chọn
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Đơn</th>
                        <th class="p-4">Khách Hàng</th>
                        <th class="p-4">Số Điện Thoại</th>
                        <th class="p-4">Gói Dịch Vụ</th>
                        <th class="p-4">Ngày Chụp</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachDon) && count($danhSachDon) > 0)
                        @foreach($danhSachDon as $don)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $don->MaDatLich }}</td>
                                <td class="p-4 font-bold text-purple-700">{{ $don->TenKhachHang ?? 'Khách lẻ' }}</td>
                                <td class="p-4 font-mono text-gray-600">{{ $don->SoDienThoai ?? '-' }}</td>
                                <td class="p-4 font-bold text-teal-600">{{ $don->TenDichVu ?? 'Gói tiêu chuẩn' }}</td>
                                <td class="p-4 font-mono font-bold text-indigo-600">{{ $don->NgayChup ? date('d/m/Y', strtotime($don->NgayChup)) : '-' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-gray-100 text-gray-700">
                                        {{ $don->TrangThai }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400 italic">Không có đơn đặt lịch nào trong khoảng thời gian này.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center">
            {{ $danhSachDon->links() }}
        </div>
    </div>
@endsection