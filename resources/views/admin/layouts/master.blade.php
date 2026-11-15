<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Trị - 22fotoholicstudio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR BÊN TRÁI -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between hidden md:flex">
            <div>
                <!-- Logo Studio -->
                <div class="p-6 text-center border-b border-gray-100 bg-black text-white">
                    <h1 class="text-sm font-black tracking-widest uppercase">22FOTOHOLICSTUDIO</h1>
                    <p class="text-[10px] text-gray-400 mt-0.5">Hệ thống Quản lý & Đặt lịch</p>
                </div>

                <!-- Thông tin nhân sự đang đăng nhập (Xử lý an toàn chống lỗi undefined) -->
                @php
                    $currentNhanVien = $nhanVien ?? session('nhanvien') ?? session('taikhoan') ?? session('khachhang');
                @endphp
                <div class="p-4 m-4 bg-purple-50 rounded-2xl border border-purple-100 text-xs space-y-1">
                    <div class="font-bold text-gray-800 flex items-center">
                        <i class="fa-solid fa-user-tie text-purple-600 mr-2"></i> 
                        {{ is_object($currentNhanVien) ? ($currentNhanVien->TenDangNhap ?? $currentNhanVien->HoTen ?? 'Nhân sự') : (is_array($currentNhanVien) ? ($currentNhanVien['TenDangNhap'] ?? $currentNhanVien['HoTen'] ?? 'Nhân sự') : 'Nhân sự') }}
                    </div>
                    <div class="text-[11px] text-purple-700 font-semibold">Chức vụ: Quản lý / Nhân viên</div>
                    
                    <form action="{{ route('client.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-rose-600 font-bold hover:underline text-[11px] bg-transparent border-0 p-0 cursor-pointer mt-1 flex items-center">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i> Đăng xuất
                        </button>
                    </form>
                </div>

                <!-- Menu điều hướng quản trị -->
                <nav class="px-4 space-y-1 text-xs font-bold">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-chart-pie w-5 mr-2 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-teal-600' }}"></i> Dashboard Tổng Quan
                    </a>
                    <!-- Mục Quản Lý Đặt Lịch trên Sidebar -->
                    <a href="{{ route('admin.datlich.index') }}" class="flex items-center px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.datlich.*') ? 'bg-teal-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-calendar-check mr-3 text-sm {{ request()->routeIs('admin.datlich.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Đặt Lịch
                    </a>
                    <a href="{{ route('admin.lichchup.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.lichchup.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-calendar-days w-5 mr-2 {{ request()->routeIs('admin.lichchup.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Lịch Chụp
                    </a>

                    <a href="{{ route('admin.khunggio.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.khunggio.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-clock w-5 mr-2 {{ request()->routeIs('admin.khunggio.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Khung Giờ
                    </a>

                    <a href="{{ route('admin.lichlamviec.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.lichlamviec.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-calendar-days w-5 mr-2 {{ request()->routeIs('admin.lichlamviec.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Lịch Làm Việc
                    </a>
                    
                    <a href="{{ route('admin.concept.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.concept.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-camera-retro w-5 mr-2 {{ request()->routeIs('admin.concept.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Concept
                    </a>

                    <a href="{{ route('admin.dichvu.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dichvu.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-box-archive w-5 mr-2 {{ request()->routeIs('admin.dichvu.*') ? 'text-white' : 'text-teal-600' }}"></i> Gói Dịch Vụ & Add-ons
                    </a>

                    <a href="{{ route('admin.voucher.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.voucher.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-ticket w-5 mr-2 {{ request()->routeIs('admin.voucher.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Voucher
                    </a>

                    <a href="{{ route('admin.hoadon.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.hoadon.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-file-invoice-dollar w-5 mr-2 {{ request()->routeIs('admin.hoadon.*') ? 'text-white' : 'text-teal-600' }}"></i> Quản Lý Hóa Đơn
                    </a>

                    <a href="{{ route('admin.khachhang.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.khachhang.*') ? 'bg-teal-500 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100' }} rounded-xl transition">
                        <i class="fa-solid fa-users w-5 mr-2 {{ request()->routeIs('admin.khachhang.*') ? 'text-white' : 'text-teal-600' }}"></i> Danh Sách Khách Hàng
                    </a>
                </nav>
            </div>

            <div class="p-4 text-center text-[10px] text-gray-400 border-t border-gray-100">
                22fotoholicstudio v1.0 &copy; 2026
            </div>
        </aside>

        <!-- NỘI DUNG CHÍNH BÊN PHẢI -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            @yield('content')
        </main>

    </div>

</body>
</html>