<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>22fotoholic studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-italic { font-family: 'Playfair Display', serif; font-style: italic; }
    </style>
</head>
<body class="bg-[#121212] text-gray-200 antialiased overflow-x-hidden">

    <header class="fixed top-0 left-0 right-0 z-50 bg-black/40 backdrop-blur-md border-b border-white/10">
        <div class="max-w-[1400px] mx-auto px-6 py-4 flex items-center justify-between">
            
            <!-- 1. Logo góc trái -->
            <div class="shrink-0">
                <a href="{{ route('client.home') }}" class="text-2xl md:text-3xl font-bold tracking-tight text-white font-serif-italic">
                    22fotoholic
                </a>
            </div>
            
            <nav class="hidden lg:flex flex-1 justify-center items-center space-x-6 xl:space-x-8 text-xs font-medium tracking-[0.2em] uppercase text-stone-200 px-4">
                <a href="{{ route('client.home') }}" class="whitespace-nowrap text-white border-b-2 border-white pb-1 font-semibold">TRANG CHỦ</a>
                <a href="#concepts" class="whitespace-nowrap hover:text-white transition">CONCEPT</a>
                <a href="#services" class="whitespace-nowrap hover:text-white transition">BẢNG GIÁ</a>
                <a href="#" class="whitespace-nowrap hover:text-white transition">PREMIUM BY VÀNG</a>
                <a href="#" class="hover:text-white transition whitespace-nowrap">HỎI ĐÁP</a>
                <a href="#" class="whitespace-nowrap hover:text-white transition">CÂU CHUYỆN</a>
                <a href="#" class="whitespace-nowrap hover:text-white transition">LIÊN HỆ</a>
            </nav>

            @php
                // Lấy số lượng thông báo chưa đọc của khách hàng đang đăng nhập (Hỗ trợ cả mảng và object)
                $khachHang = session('khachhang');
                $soThongBaoChuaDoc = 0;
                
                if ($khachHang) {
                    $maKhachHang = is_array($khachHang) ? ($khachHang['MaKhachHang'] ?? null) : ($khachHang->MaKhachHang ?? null);
                    
                    if ($maKhachHang) {
                        $soThongBaoChuaDoc = DB::table('thongbao')
                            ->where('MaKhachHang', $maKhachHang)
                            ->where('TrangThaiDoc', 'Chưa đọc')
                            ->count();
                    }
                }
            @endphp

            <!-- Icon Chuông Thông Báo có khung tròn nổi bật -->
            <a href="{{ route('client.thongbao') }}" class="relative w-9 h-9 rounded-full bg-stone-800 border border-white/40 text-white flex items-center justify-center shadow-md hover:border-white hover:bg-stone-700 transition" title="Thông báo hệ thống">
                <i class="fa-solid fa-bell text-xs text-white"></i>
                @if($soThongBaoChuaDoc > 0)
                    <span class="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-black px-1.5 py-0.2 rounded-full shadow-lg animate-pulse border border-black">
                        {{ $soThongBaoChuaDoc }}
                    </span>
                @endif
            </a>

            <!-- 3. Cụm Biểu Tượng Người Dùng & Nút ĐẶT LỊCH góc phải -->
            <div class="flex items-center space-x-4 shrink-0">
                
                @if(session()->has('khachhang'))
                    <!-- USER PROFILE ICON -->
                    <div class="relative group flex items-center space-x-2 cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-stone-800 border border-white/40 text-white flex items-center justify-center font-semibold shadow-md group-hover:border-white transition">
                            <i class="fa-regular fa-user text-xs"></i>
                        </div>
                        <span class="text-xs font-semibold tracking-wider text-stone-200 whitespace-nowrap hidden sm:inline-block">
                            {{ data_get(session('khachhang'), 'HoTen', 'Thanh Tiền') }}
                        </span>

                        <!-- Menu xổ xuống khi rê chuột vào Avatar/Tên -->
                        <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block z-50">
                            <div class="bg-[#1c1c1c] border border-white/10 rounded-xl shadow-2xl py-2 text-xs">
                                <!-- Thêm liên kết Hồ Sơ Cá Nhân -->
                                <a href="{{ route('client.hosocanhan') }}" class="block px-4 py-2.5 text-stone-300 hover:bg-white/10 hover:text-white transition">
                                    <i class="fa-solid fa-user-gear mr-2 text-teal-400"></i> Hồ Sơ Cá Nhân
                                </a>
                                <a href="{{ route('client.booking.history') }}" class="block px-4 py-2.5 text-stone-300 hover:bg-white/10 hover:text-white transition">
                                    <i class="fa-solid fa-clock-rotate-left mr-2"></i> Lịch Sử Đặt Lịch
                                </a>
                                <div class="border-t border-white/10 my-1"></div>
                                <form action="{{ route('client.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-rose-400 hover:bg-rose-500/10 transition">
                                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Đăng Xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('client.login') }}" class="text-xs font-semibold tracking-widest text-stone-300 hover:text-white uppercase transition whitespace-nowrap">
                        ĐĂNG NHẬP
                    </a>
                @endif

                <!-- Nút ĐẶT LỊCH Header -->
                <a href="{{ route('client.booking.form') }}" class="whitespace-nowrap shrink-0 border border-white/80 hover:bg-white hover:text-black text-white text-xs font-semibold tracking-[0.2em] px-6 py-2 rounded-full transition duration-300">
                    ĐẶT LỊCH
                </a>
            </div>

        </div>
    </header>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Social Floating Widget -->
    <div class="fixed right-6 top-1/2 -translate-y-1/2 z-50 flex flex-col space-y-4">
        <a href="#" class="w-11 h-11 rounded-full bg-[#0084FF] text-white flex items-center justify-center shadow-xl hover:scale-110 transition duration-300">
            <i class="fa-brands fa-facebook-messenger text-xl"></i>
        </a>
        <a href="#" class="w-11 h-11 rounded-full bg-white text-blue-600 flex items-center justify-center shadow-xl hover:scale-110 transition duration-300 font-bold text-xs">
            Zalo
        </a>
        <a href="#" class="w-11 h-11 rounded-full bg-gradient-to-tr from-yellow-500 via-rose-500 to-purple-600 text-white flex items-center justify-center shadow-xl hover:scale-110 transition duration-300">
            <i class="fa-brands fa-instagram text-xl"></i>
        </a>
        <a href="#" class="w-11 h-11 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-xl hover:scale-110 transition duration-300">
            <i class="fa-solid fa-phone text-base"></i>
        </a>
    </div>

</body>
</html>