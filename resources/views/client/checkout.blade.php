<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán & Đặt Cọc - 22fotoholicstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .select-card {
            border: 2px solid #e5e7eb;
            border-radius: 1rem;
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            background-color: #ffffff;
        }
        .select-card.active {
            border-color: #000000 !important;
            background-color: #f9fafb !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-100/60 to-pink-100/50 text-gray-900 font-sans py-10 min-h-screen">

    <main class="max-w-5xl mx-auto px-4">
        <div class="bg-purple-50/90 backdrop-blur-sm border border-purple-200/80 rounded-3xl shadow-lg p-6 sm:p-10">
            
            <!-- Header Studio & Đếm Ngược 5 Phút -->
            <header class="border-b border-purple-200/60 pb-6 mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h1 class="text-xl font-black tracking-widest uppercase">22FOTOHOLICSTUDIO</h1>
                    <span class="text-xs font-bold text-purple-700 bg-purple-100 px-3 py-1 rounded-full border border-purple-300 mt-1 inline-block">
                        MÃ ĐƠN: #{{ $datLich->MaDatLich }}
                    </span>
                </div>

                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-2 rounded-2xl flex items-center space-x-2 text-xs font-bold shadow-sm">
                    <i class="fa-solid fa-clock animate-pulse"></i>
                    <span>Thời gian giữ suất chụp: <strong id="countdownTimer" class="text-sm font-black font-mono">5:00</strong></span>
                </div>
            </header>

            <!-- Hiển thị thông báo lỗi nếu có từ Controller -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-600 rounded-2xl text-xs font-bold shadow-sm">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client.checkout.process', $datLich->MaDatLich) }}" method="POST">
                @csrf
                <input type="hidden" name="TongTienBanDau" value="{{ $datLich->TongTien }}">
                <input type="hidden" name="SoTienGiam" id="inputSoTienGiam" value="0">
                <input type="hidden" name="MaVoucher" id="inputMaVoucher" value="">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    
                    <!-- CỘT BÊN TRÁI: CHI TIẾT ĐƠN & TÙY CHỌN THANH TOÁN -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- 1. THÔNG TIN CHI TIẾT ĐƠN CHỤP -->
                        <div class="bg-white rounded-2xl p-6 border border-purple-100 shadow-sm space-y-4">
                            <h2 class="text-xs font-black uppercase tracking-widest text-gray-700 border-b pb-3 border-gray-100 flex items-center">
                                <i class="fa-solid fa-receipt mr-2 text-black"></i> CHI TIẾT ĐƠN CHỤP
                            </h2>

                            <div class="space-y-2 text-xs">
                                <div class="flex justify-between py-1 border-b border-gray-50">
                                    <span class="text-gray-500 font-semibold">Khách hàng:</span>
                                    <span class="font-bold text-gray-800">{{ $datLich->HoTenKhach }} ({{ $datLich->SoDienThoaiKhach }})</span>
                                </div>
                                <div class="flex justify-between py-1 border-b border-gray-50">
                                    <span class="text-gray-500 font-semibold">Ngày & Khung giờ chụp:</span>
                                    <span class="font-bold text-gray-800">
                                        {{ $datLich->NgayChup ? date('d/m/Y', strtotime($datLich->NgayChup)) : 'Chưa chọn' }} 
                                        ({{ $khungGio ? $khungGio->GioBatDau . ' - ' . $khungGio->GioKetThuc : '' }})
                                    </span>
                                </div>
                                <div class="flex justify-between py-1 border-b border-gray-50">
                                    <span class="text-gray-500 font-semibold">Gói dịch vụ chính:</span>
                                    <span class="font-bold text-gray-800">{{ $dichVu->TenDichVu }} ({{ number_format($dichVu->DonGia, 0, ',', '.') }}đ)</span>
                                </div>
                                <div class="flex justify-between py-1 border-b border-gray-50">
                                    <span class="text-gray-500 font-semibold">Concept phong cách:</span>
                                    <span class="font-bold text-purple-700">{{ $concept->TenConcept }} {{ $chiTietConcept ? '- ' . $chiTietConcept->TenChiTietConcept : '' }}</span>
                                </div>

                                @if(count($dichVuDiKems) > 0)
                                    <div class="pt-2">
                                        <span class="text-gray-500 font-semibold block mb-1">Dịch vụ đi kèm chọn thêm:</span>
                                        <div class="space-y-1 bg-purple-50/50 p-3 rounded-xl border border-purple-100">
                                            @foreach($dichVuDiKems as $dk)
                                                <div class="flex justify-between text-[11px]">
                                                    <span class="text-gray-700">+ {{ $dk->TenDichVuDiKem }} (x{{ $dk->SoLuong }})</span>
                                                    <span class="font-bold text-gray-900">{{ number_format($dk->ThanhTien, 0, ',', '.') }}đ</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- MÃ GIẢM GIÁ VOUCHER -->
                            <div class="pt-3 border-t border-purple-100 space-y-2">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase">MÃ GIẢM GIÁ (VOUCHER)</label>
                                <select id="selectVoucher" class="w-full border border-gray-200 rounded-xl p-2.5 text-xs focus:outline-none focus:border-black bg-white">
                                    <option value="" data-type="" data-value="0" data-max="0">-- Không sử dụng voucher --</option>
                                    
                                    @if(isset($vouchers) && count($vouchers) > 0)
                                        @foreach($vouchers as $vc)
                                            <option value="{{ $vc->MaVoucher }}" 
                                                    data-type="{{ $vc->LoaiGiamGia }}" 
                                                    data-value="{{ $vc->GiaTriGiam }}" 
                                                    data-max="{{ $vc->GiamToiDa ?? 0 }}">
                                                [{{ $vc->MaVoucher }}] {{ $vc->TenVoucher ?? $vc->MoTa ?? '' }} - Giảm: {{ number_format($vc->GiaTriGiam) }}{{ $vc->LoaiGiamGia == 'PhanTram' ? '%' : ' VNĐ' }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Tài khoản chưa đủ điều kiện nhận voucher nào</option>
                                    @endif
                                </select>
                            </div>

                            <div class="pt-3 border-t border-purple-100 space-y-1 text-xs">
                                <div class="flex justify-between text-gray-500">
                                    <span>Tổng chi phí ban đầu:</span>
                                    <span>{{ number_format($datLich->TongTien, 0, ',', '.') }} VNĐ</span>
                                </div>
                                <div class="flex justify-between text-green-600 font-bold" id="discountRow" style="display: none;">
                                    <span>Giảm giá Voucher:</span>
                                    <span id="displayDiscount">-0 VNĐ</span>
                                </div>
                                <div class="flex justify-between items-center font-black text-gray-900 text-sm pt-1">
                                    <span>Tổng phải trả:</span>
                                    <span id="displayFinalTotal" class="text-base text-purple-900">{{ number_format($datLich->TongTien, 0, ',', '.') }} VNĐ</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. CHỌN LOẠI THANH TOÁN -->
                        <div class="bg-white rounded-2xl p-6 border border-purple-100 shadow-sm space-y-3">
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-700">
                                1. CHỌN LOẠI THANH TOÁN
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="select-card type-card active" data-type="Đặt cọc">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-gray-800">Đặt cọc (30%)</span>
                                        <i class="fa-solid fa-circle-check text-black text-sm check-icon"></i>
                                    </div>
                                    <span id="displayDepositAmount" class="text-sm font-black text-purple-800 block mt-1">{{ number_format($datLich->TienCoc, 0, ',', '.') }}đ</span>
                                </div>

                                <div class="select-card type-card" data-type="Thanh toán toàn bộ">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-gray-800">Thanh toán toàn bộ (100%)</span>
                                        <i class="fa-solid fa-circle-check text-gray-300 text-sm check-icon"></i>
                                    </div>
                                    <span id="displayFullAmount" class="text-sm font-black text-purple-800 block mt-1">{{ number_format($datLich->TongTien, 0, ',', '.') }}đ</span>
                                </div>
                            </div>
                            <input type="hidden" name="LoaiThanhToan" id="inputLoaiThanhToan" value="Đặt cọc">
                            <input type="hidden" name="SoTien" id="inputSoTien" value="{{ $datLich->TienCoc }}">
                        </div>

                        <!-- 3. CHỌN PHƯƠNG THỨC THANH TOÁN -->
                        <div class="bg-white rounded-2xl p-6 border border-purple-100 shadow-sm space-y-3">
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-700">
                                2. CHỌN PHƯƠNG THỨC THANH TOÁN
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <div class="select-card method-card active" data-method="Chuyển khoản QR">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-qrcode text-purple-600 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">VietQR Ngân hàng</span>
                                    </div>
                                </div>

                                <div class="select-card method-card" data-method="Ví MoMo">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-wallet text-pink-500 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">Ví MoMo</span>
                                    </div>
                                </div>

                                <div class="select-card method-card" data-method="Thẻ ZaloPay">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-credit-card text-blue-500 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">Ví ZaloPay</span>
                                    </div>
                                </div>

                                <div class="select-card method-card" data-method="Ví ShopeePay">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-bag-shopping text-orange-500 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">Ví ShopeePay</span>
                                    </div>
                                </div>

                                <div class="select-card method-card" data-method="Thẻ ATM Nội Địa">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-building-columns text-indigo-600 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">Thẻ ATM (Napas)</span>
                                    </div>
                                </div>

                                <div class="select-card method-card" data-method="Thẻ Quốc Tế">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-brands fa-cc-visa text-blue-700 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">Visa / Mastercard</span>
                                    </div>
                                </div>

                                <div class="select-card method-card col-span-2 sm:col-span-3" data-method="Thanh toán trực tiếp tại Studio">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-store text-green-600 text-base"></i>
                                        <span class="text-xs font-bold text-gray-800">Thanh toán trực tiếp tại Studio (Tiền mặt / Máy POS)</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="PhuongThuc" id="inputPhuongThuc" value="Chuyển khoản QR">
                        </div>

                    </div>

                    <!-- CỘT BÊN PHẢI: HIỂN THỊ MÃ QR HOẶC FORM NHẬP THẺ -->
                    <div class="lg:col-span-5 text-center space-y-6">
                        <div class="bg-white rounded-2xl p-6 border border-purple-100 shadow-sm flex flex-col items-center">
                            
                            <div id="qrPaymentBox" class="w-full flex flex-col items-center">
                                <h3 class="text-xs font-black uppercase tracking-widest text-gray-700 mb-1">MÃ QUÉT THANH TOÁN</h3>
                                <p class="text-[11px] text-gray-500 mb-3">Số tiền cần quét: <span id="displayPayAmount" class="font-bold text-purple-700 text-xs">{{ number_format($datLich->TienCoc, 0, ',', '.') }}đ</span></p>

                                <div class="p-3 bg-purple-50 border-2 border-purple-200 rounded-2xl mb-4 shadow-inner">
                                    <img id="qrCodeImg" 
                                         src="https://img.vietqr.io/image/MB-0901234567-compact2.png?amount={{ $datLich->TienCoc }}&addInfo=DATCOC%20{{ $datLich->MaDatLich }}&accountName=22FOTOHOLICSTUDIO" 
                                         alt="Mã QR Thanh Toán" class="w-52 h-52 object-contain rounded-xl">
                                </div>

                                <div id="bankDetailsInfo" class="w-full text-left space-y-2 bg-gray-50 p-4 rounded-xl border border-gray-100 text-xs">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Ngân hàng / Đơn vị:</span>
                                        <span id="displayBankName" class="font-bold">MBBank (NH Quân Đội)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Số tài khoản / SĐT:</span>
                                        <span id="displayAccountNo" class="font-bold font-mono">0901234567</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Chủ tài khoản:</span>
                                        <span class="font-bold">22FOTOHOLICSTUDIO</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Nội dung CK:</span>
                                        <span id="displayContent" class="font-bold text-red-600 font-mono">DATCOC {{ $datLich->MaDatLich }}</span>
                                    </div>
                                </div>
                            </div>

                            <div id="cardPaymentBox" class="hidden w-full text-left space-y-3 pt-2">
                                <h3 class="text-xs font-black uppercase tracking-widest text-gray-700 mb-2 text-center">NHẬP THÔNG TIN THẺ</h3>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1">Số thẻ *</label>
                                    <input type="text" placeholder="1234 5678 9012 3456" class="w-full border border-gray-200 rounded-xl p-2.5 text-xs font-mono focus:outline-none focus:border-black bg-white">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1">Tên in trên thẻ *</label>
                                    <input type="text" placeholder="NGUYEN VAN A" class="w-full border border-gray-200 rounded-xl p-2.5 text-xs uppercase focus:outline-none focus:border-black bg-white">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-600 mb-1">Ngày phát hành / Hạn *</label>
                                        <input type="text" placeholder="MM/YY" class="w-full border border-gray-200 rounded-xl p-2.5 text-xs font-mono focus:outline-none focus:border-black bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-600 mb-1">Mã CVC/CVV *</label>
                                        <input type="password" maxlength="4" placeholder="***" class="w-full border border-gray-200 rounded-xl p-2.5 text-xs font-mono focus:outline-none focus:border-black bg-white">
                                    </div>
                                </div>
                                <p class="text-[10px] text-gray-400 italic text-center mt-2">Xác thực mã OTP SMS 3D-Secure sẽ được gửi qua Ngân hàng liên kết.</p>
                            </div>

                            <div id="cashPaymentBox" class="hidden w-full py-8 text-center space-y-3">
                                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                                    <i class="fa-solid fa-store"></i>
                                </div>
                                <h4 class="text-xs font-bold text-gray-800 uppercase">Thanh toán trực tiếp tại Studio</h4>
                                <p class="text-xs text-gray-500 px-4">Quý khách vui lòng hoàn tất thanh toán tiền mặt hoặc quẹt thẻ qua máy POS tại quầy lễ tân 22fotoholicstudio khi đến lịch chụp.</p>
                            </div>

                            <button type="submit" class="mt-6 w-full bg-black text-white text-xs font-bold py-3.5 rounded-full uppercase tracking-widest hover:bg-gray-800 transition shadow-md cursor-pointer">
                                HOÀN TẤT & XÁC NHẬN <i class="fa-solid fa-circle-check ml-1 text-green-400"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </main>

    <!-- JS Xử lý Đổi Phương Thức & Ẩn/Hiện Khung QR/Card -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const originalTotal = {{ $datLich->TongTien }};
            let currentDiscount = 0;
            let currentType = 'Đặt cọc';
            let currentMethod = 'Chuyển khoản QR';
            const maDatLich = '{{ $datLich->MaDatLich }}';

            // 1. Đồng hồ Đếm ngược 5 Phút
            const TOTAL_TIME = 5 * 60;
            const timerElement = document.getElementById('countdownTimer');
            
            let endTime = localStorage.getItem('booking_end_time');
            const now = Math.floor(Date.now() / 1000);

            if (!endTime || endTime < now) {
                endTime = now + TOTAL_TIME;
                localStorage.setItem('booking_end_time', endTime);
            }

            const countdownInterval = setInterval(() => {
                const currentTime = Math.floor(Date.now() / 1000);
                let timeInSeconds = endTime - currentTime;

                if (timeInSeconds <= 0) {
                    timeInSeconds = 0;
                    clearInterval(countdownInterval);
                    localStorage.removeItem('booking_end_time');
                    alert('Thời gian giữ suất chụp đã hết hạn! Vui lòng thực hiện đặt lại lịch.');
                    window.location.href = "{{ route('client.booking.form') }}";
                }

                let minutes = Math.floor(timeInSeconds / 60);
                let seconds = timeInSeconds % 60;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                timerElement.innerText = `${minutes}:${seconds}`;
            }, 1000);

            // 2. Tính toán khi chọn Voucher
            document.getElementById('selectVoucher').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const type = selectedOption.dataset.type;
                const value = parseFloat(selectedOption.dataset.value) || 0;
                const max = parseFloat(selectedOption.dataset.max) || 0;

                document.getElementById('inputMaVoucher').value = this.value;

                if (type === 'PhanTram') {
                    currentDiscount = (originalTotal * value) / 100;
                    if (max > 0 && currentDiscount > max) currentDiscount = max;
                } else if (type === 'SoTien') {
                    currentDiscount = value;
                } else {
                    currentDiscount = 0;
                }

                document.getElementById('inputSoTienGiam').value = currentDiscount;

                if (currentDiscount > 0) {
                    document.getElementById('discountRow').style.display = 'flex';
                    document.getElementById('displayDiscount').innerText = '-' + new Intl.NumberFormat('vi-VN').format(currentDiscount) + ' VNĐ';
                } else {
                    document.getElementById('discountRow').style.display = 'none';
                }

                updatePaymentDisplay();
            });

            // 3. Chọn Loại Thanh toán
            document.querySelectorAll('.type-card').forEach(card => {
                card.addEventListener('click', function() {
                    document.querySelectorAll('.type-card').forEach(c => {
                        c.classList.remove('active');
                        c.querySelector('.check-icon').classList.replace('text-black', 'text-gray-300');
                    });
                    this.classList.add('active');
                    this.querySelector('.check-icon').classList.replace('text-gray-300', 'text-black');

                    currentType = this.dataset.type;
                    document.getElementById('inputLoaiThanhToan').value = currentType;
                    updatePaymentDisplay();
                });
            });

            // 4. Chọn Phương thức Thanh toán
            document.querySelectorAll('.method-card').forEach(card => {
                card.addEventListener('click', function() {
                    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
                    this.classList.add('active');

                    currentMethod = this.dataset.method;
                    document.getElementById('inputPhuongThuc').value = currentMethod;
                    updatePaymentDisplay();
                });
            });

            // Hàm Cập nhật hiển thị linh hoạt
            function updatePaymentDisplay() {
                const finalTotal = Math.max(0, originalTotal - currentDiscount);
                const depositAmount = finalTotal * 0.3;
                const payAmount = (currentType === 'Đặt cọc') ? depositAmount : finalTotal;

                document.getElementById('displayFinalTotal').innerText = new Intl.NumberFormat('vi-VN').format(finalTotal) + ' VNĐ';
                document.getElementById('displayDepositAmount').innerText = new Intl.NumberFormat('vi-VN').format(depositAmount) + 'đ';
                document.getElementById('displayFullAmount').innerText = new Intl.NumberFormat('vi-VN').format(finalTotal) + 'đ';
                document.getElementById('displayPayAmount').innerText = new Intl.NumberFormat('vi-VN').format(payAmount) + 'đ';
                document.getElementById('inputSoTien').value = payAmount;

                const qrBox = document.getElementById('qrPaymentBox');
                const cardBox = document.getElementById('cardPaymentBox');
                const cashBox = document.getElementById('cashPaymentBox');

                qrBox.classList.add('hidden');
                cardBox.classList.add('hidden');
                cashBox.classList.add('hidden');

                if (currentMethod === 'Thanh toán trực tiếp tại Studio') {
                    cashBox.classList.remove('hidden');
                } else if (currentMethod === 'Thẻ ATM Nội Địa' || currentMethod === 'Thẻ Quốc Tế') {
                    cardBox.classList.remove('hidden');
                } else {
                    qrBox.classList.remove('hidden');

                    const prefix = currentType === 'Đặt cọc' ? 'DATCOC' : 'THANHTOAN';
                    const content = `${prefix} ${maDatLich}`;
                    document.getElementById('displayContent').innerText = content;

                    const qrImg = document.getElementById('qrCodeImg');
                    const bankName = document.getElementById('displayBankName');
                    const accountNo = document.getElementById('displayAccountNo');

                    bankName.innerText = currentMethod;
                    accountNo.innerText = '0901234567';

                    qrImg.src = `https://img.vietqr.io/image/MB-0901234567-compact2.png?amount=${payAmount}&addInfo=${encodeURIComponent(content)}&accountName=22FOTOHOLICSTUDIO`;
                }
            }
        });
    </script>
</body>
</html>