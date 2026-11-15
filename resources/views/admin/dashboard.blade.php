<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - 22fotoholicstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Bọc toàn bộ trang trong flex và giới hạn chiều cao màn hình -->
    <div class="flex h-screen w-screen overflow-hidden">
        
        <!-- SIDEBAR BÊN TRÁI -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between shrink-0 h-full overflow-y-auto">
            <div>
                <!-- Logo Studio -->
                <div class="p-6 text-center border-b border-gray-100 bg-black text-white">
                    <h1 class="text-sm font-black tracking-widest uppercase">22FOTOHOLICSTUDIO</h1>
                    <p class="text-[10px] text-gray-400 mt-0.5">Hệ thống Quản lý & Đặt lịch</p>
                </div>

                <!-- Thông tin nhân viên / quản lý đang đăng nhập -->
                <div class="p-4 m-4 bg-purple-50 rounded-2xl border border-purple-100 text-xs space-y-1">
                    <div class="font-bold text-gray-800 flex items-center">
                        <i class="fa-solid fa-user-tie text-purple-600 mr-2"></i> 
                        {{ is_object($nhanVienSession ?? null) ? ($nhanVienSession->TenDangNhap ?? 'Nhân sự') : 'Nhân sự' }}
                    </div>
                    <div class="text-[11px] text-purple-700 font-semibold">Chức vụ: {{ $tenVaiTro ?? 'Quản lý / Nhân viên' }}</div>
                    
                    <!-- Nút Đăng xuất thực sự -->
                    <form action="{{ route('client.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-rose-600 font-bold hover:underline text-[11px] bg-transparent border-0 p-0 cursor-pointer mt-1 flex items-center">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i> Đăng xuất
                        </button>
                    </form>
                </div>

                <!-- Menu điều hướng quản trị (Đã hiển thị đầy đủ tất cả các mục) -->
                <nav class="px-4 space-y-1 text-xs font-bold">
                    <!-- Dashboard tổng quan -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-chart-pie w-5 mr-2 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-teal-600' }}"></i> Dashboard Tổng Quan
                    </a>

                    <!-- Quản Lý Đặt Lịch -->
                    <a href="{{ route('admin.datlich.index') }}" class="flex items-center px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.datlich.*') ? 'bg-teal-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-calendar-check mr-3 text-sm text-teal-600"></i> Quản Lý Đặt Lịch
                    </a>

                    <!-- Quản Lý Lịch Chụp -->
                    <a href="{{ route('admin.lichchup.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.lichchup.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-calendar-days w-5 mr-2 text-teal-600"></i> Quản Lý Lịch Chụp
                    </a>

                    <!-- Quản Lý Khung Giờ -->
                    <a href="{{ route('admin.khunggio.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.khunggio.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-clock w-5 mr-2 text-teal-600"></i> Quản Lý Khung Giờ
                    </a>

                    <!-- Quản Lý Lịch Làm Việc -->
                    <a href="{{ route('admin.lichlamviec.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.lichlamviec.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-business-time w-5 mr-2 text-teal-600"></i> Quản Lý Lịch Làm Việc
                    </a>

                    <!-- Quản Lý Concept -->
                    <a href="{{ route('admin.concept.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.concept.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-camera-retro w-5 mr-2 text-teal-600"></i> Quản Lý Concept
                    </a>

                    <!-- Gói Dịch Vụ & Add-ons -->
                    <a href="{{ route('admin.dichvu.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dichvu.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-box-archive w-5 mr-2 text-teal-600"></i> Gói Dịch Vụ & Add-ons
                    </a>

                    <!-- Quản Lý Voucher -->
                    <a href="{{ route('admin.voucher.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.voucher.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-ticket w-5 mr-2 text-teal-600"></i> Quản Lý Voucher
                    </a>

                    <!-- Quản Lý Hóa Đơn -->
                    <a href="{{ route('admin.hoadon.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.hoadon.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-file-invoice-dollar w-5 mr-2 text-teal-600"></i> Quản Lý Hóa Đơn
                    </a>

                    <!-- Danh Sách Khách Hàng -->
                    <a href="{{ route('admin.khachhang.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.khachhang.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-users w-5 mr-2 text-teal-600"></i> Danh Sách Khách Hàng
                    </a>
                </nav>
            </div>

            <div class="p-4 text-center text-[10px] text-gray-400 border-t border-gray-100">
                22fotoholicstudio v1.0 &copy; 2026
            </div>
        </aside>

        <!-- NỘI DUNG CHÍNH BÊN PHẢI -->
        <main class="flex-1 h-full overflow-y-auto p-6 md:p-8 space-y-6">
            
            <!-- Header Tiêu đề Dashboard -->
            <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                        <i class="fa-solid fa-chart-line text-teal-600 mr-2"></i> Quản Trị Hệ Thống Studio
                    </h2>
                    <p class="text-xs text-gray-500 mt-0.5">Hệ thống quản lý lịch đặt chụp ảnh & dịch vụ tại 22fotoholicstudio</p>
                </div>
                <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-bold border border-teal-200">
                    <i class="fa-solid fa-circle-check mr-1 text-teal-500"></i> Trạng thái: Hoạt động ổn định
                </div>
            </header>

            <!-- Các Thẻ Thống Kê (Stat Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm space-y-2">
                    <div class="text-xs font-bold text-gray-500 flex items-center">
                        <i class="fa-solid fa-calendar-check text-teal-600 mr-1.5"></i> Tổng Lịch Chụp
                    </div>
                    <div class="text-2xl font-black text-gray-900">{{ $tongLichChup ?? 24 }}</div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm space-y-2">
                    <div class="text-xs font-bold text-gray-500 flex items-center">
                        <i class="fa-solid fa-users text-blue-600 mr-1.5"></i> Khách Hàng
                    </div>
                    <div class="text-2xl font-black text-gray-900">{{ $tongKhachHang ?? 18 }}</div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm space-y-2">
                    <div class="text-xs font-bold text-gray-500 flex items-center">
                        <i class="fa-solid fa-file-invoice text-orange-500 mr-1.5"></i> Tổng Hóa Đơn
                    </div>
                    <div class="text-2xl font-black text-gray-900">{{ $tongHoaDon ?? 15 }}</div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm space-y-2">
                    <div class="text-xs font-bold text-gray-500 flex items-center">
                        <i class="fa-solid fa-sack-dollar text-green-600 mr-1.5"></i> Doanh Thu Xác Nhận
                    </div>
                    <div class="text-xl font-black text-green-600">{{ number_format($doanhThu ?? 4500000, 0, ',', '.') }}đ</div>
                </div>
            </div>

            <!-- Bảng Dữ Liệu Đơn Đặt Lịch Gần Nhất -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm overflow-hidden space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                        <i class="fa-solid fa-clock-rotate-left mr-2 text-teal-600"></i> DANH SÁCH ĐƠN ĐẶT LỊCH GẦN NHẤT
                    </h3>
                    <a href="{{ route('admin.datlich.index') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 transition">
                        Xem tất cả →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                                <th class="p-4">Mã Đơn</th>
                                <th class="p-4">Khách Hàng</th>
                                <th class="p-4">Số Điện Thoại</th>
                                <th class="p-4">Gói Dịch Vụ</th>
                                <th class="p-4">Ngày Đặt</th>
                                <th class="p-4">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 font-medium">
                            @if(isset($danhSachDatLichMoi) && count($danhSachDatLichMoi) > 0)
                                @foreach($danhSachDatLichMoi as $dl)
                                    <tr>
                                        <td class="p-4 font-bold text-gray-900">#{{ $dl->MaDatLich }}</td>
                                        <td class="p-4 text-gray-800">{{ $dl->HoTen }}</td>
                                        <td class="p-4 text-gray-600 font-mono">{{ $dl->SoDienThoai }}</td>
                                        <td class="p-4 text-purple-700 font-bold">{{ $dl->TenDichVu ?? 'Gói chụp tiêu chuẩn' }}</td>
                                        <td class="p-4 text-gray-500">{{ date('d/m/Y H:i', strtotime($dl->NgayDat)) }}</td>
                                        <td class="p-4">
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold 
                                                {{ $dl->TrangThai == 'Đã xác nhận' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                                {{ $dl->TrangThai }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-gray-400 italic">Chưa có đơn đặt lịch nào trong hệ thống.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>

</body>
</html>