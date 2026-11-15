<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - 22fotoholicstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-100/60 to-pink-100/50 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="max-w-md w-full bg-purple-50/90 backdrop-blur-sm border border-purple-200/80 rounded-3xl shadow-lg p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black tracking-widest uppercase">22FOTOHOLICSTUDIO</h1>
            <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Đăng nhập tài khoản khách hàng</p>
        </div>

        <!-- Thông báo lỗi tổng -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('client.login.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-2">Tên đăng nhập</label>
                <input type="text" name="TenDangNhap" value="{{ old('TenDangNhap') }}" placeholder="Nhập tên đăng nhập của bạn" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-2">Mật khẩu</label>
                <input type="password" name="MatKhau" placeholder="••••••••" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white" required>
            </div>

            <button type="submit" class="w-full bg-black text-white font-bold py-3.5 rounded-full text-xs uppercase tracking-widest hover:bg-gray-800 transition shadow-md">
                Đăng Nhập Ngay <i class="fa-solid fa-arrow-right ml-2"></i>
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-500">
            Chưa có tài khoản? 
            <a href="{{ route('client.register') }}" class="font-bold text-black underline hover:text-purple-700">Đăng ký tại đây</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('client.home') }}" class="inline-flex items-center text-xs font-semibold text-gray-600 hover:text-purple-700 transition">
                <i class="fa-solid fa-arrow-left mr-1.5"></i> Quay lại trang chủ
            </a>
        </div>
    </div>

</body>
</html>