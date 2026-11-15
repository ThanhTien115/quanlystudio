<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công - 22fotoholicstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-100/60 to-pink-100/50 text-gray-900 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-3xl p-8 border border-purple-100 shadow-2xl text-center space-y-6">
        
        <!-- Biểu tượng thành công -->
        <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto text-4xl shadow-inner animate-bounce">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-black text-gray-900 tracking-wide uppercase">THANH TOÁN THÀNH CÔNG</h1>
            <p class="text-xs text-gray-500">Hóa đơn chi tiết đã được gửi tự động về email của bạn.</p>
        </div>

        <div class="bg-purple-50 p-4 rounded-2xl border border-purple-100 space-y-2 text-xs text-left">
            <div class="flex justify-between">
                <span class="text-gray-500 font-medium">Mã đặt lịch:</span>
                <span class="font-bold text-gray-900">#{{ $maDatLich }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 font-medium">Mã hóa đơn:</span>
                <span class="font-bold text-gray-900">#{{ $maHoaDon }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 font-medium">Số tiền đã giao dịch:</span>
                <span class="font-black text-purple-700 text-sm">{{ number_format($soTienThanhToan, 0, ',', '.') }} VNĐ</span>
            </div>
        </div>

        <!-- Nút chuyển tới màn hình Lịch Sử Đặt Lịch -->
        <a href="{{ route('client.booking.history') }}" 
           class="inline-block w-full bg-black text-white text-xs font-bold py-4 rounded-full uppercase tracking-widest hover:bg-purple-900 transition shadow-lg">
            <i class="fa-solid fa-calendar-check mr-2"></i> Xem lại lịch chụp đã đặt
        </a>

    </div>

</body>
</html>