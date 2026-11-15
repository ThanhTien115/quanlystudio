<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản - 22fotoholicstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-100/60 to-pink-100/50 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="max-w-lg w-full bg-purple-50/90 backdrop-blur-sm border border-purple-200/80 rounded-3xl shadow-lg p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black tracking-widest uppercase">22FOTOHOLICSTUDIO</h1>
            <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Tạo tài khoản khách hàng mới</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('client.register.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Họ tên & SĐT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Họ và tên *</label>
                    <input type="text" name="HoTen" value="{{ old('HoTen') }}" placeholder="Nguyễn Văn A" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Số điện thoại *</label>
                    <input type="tel" name="SoDienThoai" value="{{ old('SoDienThoai') }}" placeholder="0901234567" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                </div>
            </div>

            <!-- Tên đăng nhập & Địa chỉ Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Tên đăng nhập *</label>
                    <input type="text" name="TenDangNhap" value="{{ old('TenDangNhap') }}" placeholder="VD: tien_22foto" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Địa chỉ Email *</label>
                    <input type="email" name="Email" value="{{ old('Email') }}" placeholder="nhapemail@example.com" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                </div>
            </div>

            <!-- Ngày sinh & Giới tính -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Ngày sinh</label>
                    <input type="date" name="NgaySinh" value="{{ old('NgaySinh') }}" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white text-gray-700">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Giới tính</label>
                    <div class="flex items-center space-x-4 border border-gray-200 rounded-xl px-4 py-2.5 bg-white">
                        <label class="inline-flex items-center text-sm cursor-pointer">
                            <input type="radio" name="GioiTinh" value="Nam" class="accent-black mr-1"> Nam
                        </label>
                        <label class="inline-flex items-center text-sm cursor-pointer">
                            <input type="radio" name="GioiTinh" value="Nu" class="accent-black mr-1" checked> Nữ
                        </label>
                    </div>
                </div>
            </div>

            <!-- Địa chỉ -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Địa chỉ liên hệ</label>
                <input type="text" name="DiaChi" value="{{ old('DiaChi') }}" placeholder="Quận/Huyện, TP..." class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white">
            </div>

            <!-- Mật khẩu & Nhập lại Mật khẩu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Mật khẩu *</label>
                    <input type="password" name="MatKhau" placeholder="••••••••" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Xác nhận mật khẩu *</label>
                    <input type="password" name="MatKhau_confirmation" placeholder="••••••••" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-black text-white font-bold py-3.5 rounded-full text-xs uppercase tracking-widest hover:bg-gray-800 transition shadow-md mt-4">
                Đăng Ký Tài Khoản <i class="fa-solid fa-user-plus ml-2"></i>
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-500">
            Đã có tài khoản? 
            <a href="{{ route('client.login') }}" class="font-bold text-black underline hover:text-purple-700">Đăng nhập tại đây</a>
        </div>
    </div>

</body>
</html>