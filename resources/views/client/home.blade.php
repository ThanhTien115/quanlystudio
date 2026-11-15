@extends('layouts.client')

@section('content')

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center bg-[#171717] px-8 py-28 overflow-hidden">
    
    <!-- HÌNH ẢNH NỀN 48.PNG -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('storage/48.png') }}" 
             onerror="this.onerror=null; this.src='{{ asset('48.png') }}';" 
             alt="22fotoholic background" 
             class="w-full h-full object-cover object-center filter brightness-90">
        <div class="absolute inset-0 bg-gradient-to-t from-[#121212] via-black/40 to-black/30"></div>
    </div>

    <!-- NỘI DUNG DÀN ĐỀU (Rộng max-w-[1400px]) -->
    <div class="relative z-10 max-w-[1400px] w-full mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-end pt-12">
        
        <!-- Khối nội dung bên trái -->
        <div class="lg:col-span-7 space-y-6">
            <div class="text-xs md:text-sm font-medium tracking-[0.35em] text-stone-300 uppercase">
                22 FOTOHOLIC STUDIO
            </div>
            
            <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-[105px] xl:text-[120px] font-serif-italic font-normal text-white leading-[0.95] tracking-tight">
                make every shot<br>
                timeless.
            </h1>

            <p class="text-base md:text-lg text-stone-200 max-w-lg leading-relaxed font-light pt-4">
                22 Fotoholic Studio là một studio chụp ảnh tại Thành phố Hồ Chí Minh, nơi hội tụ những tâm hồn yêu cái đẹp và khát khao lưu giữ khoảnh khắc theo cách chân thật nhất.
            </p>
        </div>

        <!-- Khối bên phải: Địa điểm & Cụm nút bấm -->
        <div class="lg:col-span-5 flex flex-col justify-between items-start lg:items-end space-y-12">
            <div class="text-xs md:text-sm font-semibold tracking-[0.25em] text-stone-200 uppercase whitespace-nowrap">
                BÌNH THẠNH &bull; HỒ CHÍ MINH
            </div>

            <!-- Cụm 2 nút bấm nằm ngang 100% không rớt chữ -->
            <div class="flex items-center gap-4 flex-nowrap w-full lg:w-auto justify-start lg:justify-end">
                
                <!-- Nút XEM CONCEPT -->
                <a href="#concepts" class="whitespace-nowrap shrink-0 border border-white/60 hover:border-white text-white text-xs md:text-sm font-semibold tracking-[0.15em] px-7 py-4 rounded-full transition duration-300 flex items-center uppercase backdrop-blur-md">
                    XEM CONCEPT <i class="fa-solid fa-arrow-right ml-2.5 text-xs"></i>
                </a>

                <!-- Nút ĐẶT LỊCH NGAY -->
                <a href="{{ route('client.booking.form') }}" class="whitespace-nowrap shrink-0 bg-white hover:bg-stone-200 text-black text-xs md:text-sm font-bold tracking-[0.15em] px-8 py-4 rounded-full transition duration-300 flex items-center uppercase shadow-2xl">
                    ĐẶT LỊCH NGAY <i class="fa-solid fa-arrow-right ml-2.5 text-xs"></i>
                </a>
            </div>
        </div>

    </div>
</section>

@endsection