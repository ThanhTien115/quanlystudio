<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>22fotoholicstudio - Đặt Lịch Chụp Ảnh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .pill-btn {
            border: 1px solid #e5e7eb;
            padding: 10px 16px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #ffffff;
            width: 100%;
        }
        .pill-btn.active {
            background-color: #000000 !important;
            color: #ffffff !important;
            border-color: #000000 !important;
        }
        .addon-card {
            border: 1px solid #e5e7eb;
            padding: 10px 16px;
            border-radius: 9999px;
            transition: all 0.2s ease;
            background-color: #ffffff;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
        }
        .addon-card.active {
            background-color: #000000 !important;
            border-color: #000000 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .addon-card.active span {
            color: #ffffff !important;
        }
        .addon-card.active .btn-qty {
            border-color: #ffffff !important;
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        .btn-qty {
            width: 26px;
            height: 26px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            transition: all 0.15s ease;
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            color: #374151;
        }
        .btn-qty:hover {
            background-color: #000000;
            color: #ffffff;
            border-color: #000000;
        }
        .concept-card.active, .sub-concept-card.active {
            border-color: #000000 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-100 via-purple-100/60 to-pink-100/50 text-gray-900 font-sans py-10 min-h-screen">

    <main class="max-w-4xl mx-auto px-4">
        <div class="bg-purple-50/85 backdrop-blur-sm border border-purple-200/80 rounded-3xl shadow-lg p-6 sm:p-10">
            
            <!-- Header Studio -->
            <header class="border-b border-purple-200/60 pb-6 mb-8 flex justify-between items-center">
                <h1 class="text-xl font-black tracking-widest uppercase">22FOTOHOLICSTUDIO</h1>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-500 font-medium bg-white/80 px-3 py-1.5 rounded-full border border-purple-200">
                        FORM ĐẶT LỊCH CHỤP
                    </span>
                    <a href="{{ route('client.home') }}" class="inline-flex items-center text-xs font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100 border border-purple-200 px-3.5 py-1.5 rounded-full transition shadow-sm font-sans normal-case">
                        <i class="fa-solid fa-arrow-left mr-1.5"></i> Quay lại trang chủ
                    </a>
                </div>
            </header>

            <form id="bookingForm" action="{{ route('client.booking.store') }}" method="POST" class="space-y-10">
                @csrf
                
                <!-- Hiển thị lỗi Validation nếu có -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl text-xs font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <p><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- 1. THÔNG TIN XÁC NHẬN KHÁCH HÀNG -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold tracking-widest uppercase text-gray-700">
                        THÔNG TIN XÁC NHẬN KHÁCH HÀNG
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="HoTen" value="{{ data_get($khachHang, 'HoTen', '') }}" placeholder="Họ và tên *" class="border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                        <input type="tel" name="SoDienThoai" value="{{ data_get($khachHang, 'SoDienThoai', '') }}" placeholder="Số điện thoại *" class="border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="email" name="Email" value="{{ data_get($khachHang, 'Email', '') }}" placeholder="Địa chỉ Email *" class="border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                        <div>
                            <input type="date" name="NgaySinh" value="{{ data_get($khachHang, 'NgaySinh', '') }}" title="Ngày sinh" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black text-gray-700 bg-white">
                        </div>
                        <div class="flex items-center space-x-4 border border-gray-200 rounded-lg px-4 py-2.5 bg-white">
                            <span class="text-xs font-bold text-gray-500 uppercase">Giới tính:</span>
                            <label class="inline-flex items-center text-sm cursor-pointer">
                                <input type="radio" name="GioiTinh" value="Nam" class="accent-black mr-1" {{ data_get($khachHang, 'GioiTinh') == 'Nam' ? 'checked' : '' }}> Nam
                            </label>
                            <label class="inline-flex items-center text-sm cursor-pointer">
                                <input type="radio" name="GioiTinh" value="Nữ" class="accent-black mr-1" {{ data_get($khachHang, 'GioiTinh', 'Nữ') == 'Nữ' ? 'checked' : '' }}> Nữ
                            </label>
                        </div>
                    </div>

                    <input type="text" name="DiaChi" value="{{ data_get($khachHang, 'DiaChi', '') }}" placeholder="Địa chỉ liên hệ (Quận/Huyện, TP...)" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white">
                    <textarea name="GhiChu" placeholder="Ghi chú thêm về trang phục / phong cách mong muốn..." rows="2" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white"></textarea>
                </div>

                <!-- 2. CONCEPT & CHI TIẾT CONCEPT -->
                <div class="pt-6 border-t border-purple-200/60">
                    <label class="block text-xs font-bold tracking-widest uppercase text-gray-700 mb-4">
                        1. CHỌN NHÓM CONCEPT (CHỌN 1)
                    </label>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 mb-6">
                        @foreach($concepts as $cp)
                            <div class="concept-card cursor-pointer border-2 border-gray-100 rounded-2xl overflow-hidden hover:border-gray-400 transition bg-white text-center p-2 shadow-sm"
                                data-id="{{ $cp->MaConcept }}" data-name="{{ $cp->TenConcept }}">
                                <div class="h-28 w-full rounded-xl overflow-hidden mb-2 bg-gray-100">
                                    <img src="{{ asset('storage/' . $cp->HinhAnh) }}" alt="{{ $cp->TenConcept }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider block text-gray-800">{{ $cp->TenConcept }}</span>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="MaConcept" id="selectedConcept" required>

                    <!-- Khung Chi Tiết Concept -->
                    <div id="subConceptWrapper" class="hidden mt-6 p-6 bg-white/90 rounded-3xl border border-purple-200 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-xs font-bold tracking-widest uppercase text-gray-500">
                                <i class="fa-solid fa-camera mr-1 text-black"></i> ĐÃ CHỌN: <span id="currentConceptTitle" class="text-black font-extrabold"></span> - VUI LÒNG CHỌN PHONG CÁCH CHI TIẾT:
                            </label>
                            <button type="button" id="btnBackToSubConcepts" class="hidden text-xs font-bold text-gray-600 hover:text-black transition bg-gray-100 px-3 py-1.5 rounded-full border border-gray-300 items-center gap-1.5">
                                <i class="fa-solid fa-arrow-left"></i> Chọn lại phong cách
                            </button>
                        </div>

                        <div id="subConceptGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach($chiTietConcepts as $ct)
                                <div class="sub-concept-card hidden cursor-pointer border-2 border-gray-200 rounded-2xl overflow-hidden hover:border-black transition bg-white p-2 text-center"
                                    data-parent="{{ $ct->MaConcept }}" 
                                    data-id="{{ $ct->MaChiTietConcept }}"
                                    data-name="{{ $ct->TenChiTietConcept }}">
                                    <div class="h-32 w-full rounded-xl overflow-hidden mb-2 bg-gray-100">
                                        <img src="{{ asset('storage/' . $ct->HinhAnh) }}" alt="{{ $ct->TenChiTietConcept }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-xs font-semibold text-gray-700 block line-clamp-1">{{ $ct->TenChiTietConcept }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div id="confirmSubConceptBox" class="hidden mt-5 text-center border-t border-purple-100 pt-4">
                            <button type="button" id="btnConfirmSubConcept" class="bg-black text-white px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-gray-800 transition shadow-md inline-flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-green-400"></i> Xác nhận chọn phong cách này
                            </button>
                        </div>
                        <input type="hidden" name="MaChiTietConcept" id="selectedChiTietConcept">
                    </div>
                </div>

                <!-- 3. GÓI DỊCH VỤ CHÍNH -->
                <div class="pt-6 border-t border-purple-200/60">
                    <label class="block text-xs font-bold tracking-widest uppercase text-gray-700 mb-4">
                        GÓI DỊCH VỤ CHÍNH
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($dichVus as $dv)
                            <button type="button" 
                                    class="pill-btn service-pill" 
                                    data-id="{{ $dv->MaDichVu }}"
                                    data-price="{{ $dv->DonGia }}">
                                {{ $dv->TenDichVu }} ({{ number_format($dv->DonGia, 0, ',', '.') }}Đ)
                            </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="MaDichVu" id="selectedService" required>
                </div>

                <!-- 4. DỊCH VỤ ĐI KÈM -->
                <div class="pt-6 border-t border-purple-200/60">
                    <label class="block text-xs font-bold tracking-widest uppercase text-gray-700 mb-4">
                        DỊCH VỤ ĐI KÈM (TÙY CHỌN BỔ SUNG)
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($dichVuDiKems as $dk)
                            <div class="addon-card addon-item" id="addon-card-{{ $dk->MaDichVuDiKem }}" data-id="{{ $dk->MaDichVuDiKem }}">
                                <div class="text-left pr-2 pointer-events-none">
                                    <span class="text-xs font-bold uppercase block text-gray-800">
                                        + {{ $dk->TenDichVuDiKem }}
                                    </span>
                                    <span class="text-[11px] text-gray-500 font-medium">
                                        +{{ number_format($dk->DonGia, 0, ',', '.') }}Đ
                                        @if(!empty($dk->DonViTinh))
                                            / {{ $dk->DonViTinh }}
                                        @endif
                                    </span>
                                </div>

                                <div class="flex items-center space-x-2 shrink-0">
                                    <button type="button" class="btn-qty btn-minus" data-id="{{ $dk->MaDichVuDiKem }}">-</button>
                                    <span class="qty-display text-xs font-black min-w-[16px] text-center pointer-events-none" id="qty-{{ $dk->MaDichVuDiKem }}">1</span>
                                    <button type="button" class="btn-qty btn-plus" data-id="{{ $dk->MaDichVuDiKem }}">+</button>
                                    
                                    <input type="hidden" 
                                           name="dich_vu_di_kem[{{ $dk->MaDichVuDiKem }}]" 
                                           id="input-qty-{{ $dk->MaDichVuDiKem }}" 
                                           class="addon-qty-input"
                                           data-price="{{ $dk->DonGia }}" 
                                           value="0">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 5. CHỌN NGÀY VÀ KHUNG GIỜ (Ẩn hoàn toàn khung giờ đã kín chỗ) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-purple-200/60">
                    <div>
                        <label class="block text-xs font-bold tracking-widest uppercase text-gray-700 mb-2">NGÀY CHỤP DỰ KIẾN</label>
                        <input type="date" id="inputNgayChup" name="NgayChup" min="{{ date('Y-m-d') }}" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold tracking-widest uppercase text-gray-700 mb-2">KHUNG GIỜ KHẢ DỤNG</label>
                        <select id="selectKhungGio" name="MaKhungGio" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:border-black bg-white" required>
                            <option value="">-- Vui lòng chọn ngày chụp trước --</option>
                        </select>
                    </div>
                </div>

                <!-- TỔNG TIỀN VÀ NÚT ĐẶT LỊCH -->
                <div class="bg-white rounded-2xl p-6 flex flex-col md:flex-row justify-between items-center gap-4 border border-purple-200 shadow-sm">
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider block">Tạm tính dịch vụ</span>
                        <span id="totalDisplay" class="text-2xl font-black text-black">0 VNĐ</span>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-black text-white font-bold px-10 py-4 rounded-full text-xs uppercase tracking-widest hover:bg-gray-800 transition shadow-md">
                        Tiến Hành Đặt Cọc & Đặt Lịch <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- JavaScript Xử Lý Động Khung Giờ & Concept -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Xử lý tải Khung giờ theo ngày (Ẩn hoàn toàn khung giờ đã kín)
            const inputNgayChup = document.getElementById('inputNgayChup');
            const selectKhungGio = document.getElementById('selectKhungGio');

            inputNgayChup.addEventListener('change', function() {
                const selectedDate = this.value;
                if (!selectedDate) return;

                selectKhungGio.innerHTML = '<option value="">Đang tải khung giờ...</option>';

                // Gọi tới route API getAvailableTimeSlots
                fetch(`{{ route('client.api.timeslots') }}?ngay=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        selectKhungGio.innerHTML = '<option value="">-- Chọn ca chụp --</option>';
                        
                        let hasAvailable = false;
                        data.forEach(slot => {
                            // Chỉ thêm vào option nếu khung giờ còn trống (ConTroong == true). Khung giờ kín bị ẩn hoàn toàn.
                            if (slot.ConTroong) {
                                const option = document.createElement('option');
                                option.value = slot.MaKhungGio;
                                option.textContent = slot.TenHienThi;
                                selectKhungGio.appendChild(option);
                                hasAvailable = true;
                            }
                        });

                        if (!hasAvailable) {
                            selectKhungGio.innerHTML = '<option value="">-- Ngày này đã kín toàn bộ lịch --</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi tải khung giờ:', error);
                        selectKhungGio.innerHTML = '<option value="">Không thể tải khung giờ. Thử lại sau.</option>';
                    });
            });

            // 2. Xử lý Chọn Nhóm Concept
            document.querySelectorAll('.concept-card').forEach(card => {
                card.addEventListener('click', function() {
                    document.querySelectorAll('.concept-card').forEach(c => c.classList.remove('active'));
                    this.classList.add('active');

                    const conceptId = this.dataset.id;
                    const conceptName = this.dataset.name;
                    document.getElementById('selectedConcept').value = conceptId;

                    const subWrapper = document.getElementById('subConceptWrapper');
                    subWrapper.classList.remove('hidden');
                    document.getElementById('currentConceptTitle').innerText = conceptName;

                    resetSubConceptState(conceptId);
                });
            });

            // 3. Xử lý Chọn Chi Tiết Concept
            let currentSelectedSubCard = null;
            document.querySelectorAll('.sub-concept-card').forEach(subCard => {
                subCard.addEventListener('click', function() {
                    if (document.getElementById('btnBackToSubConcepts').classList.contains('flex')) {
                        return;
                    }
                    document.querySelectorAll('.sub-concept-card').forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    currentSelectedSubCard = this;
                    document.getElementById('confirmSubConceptBox').classList.remove('hidden');
                });
            });

            document.getElementById('btnConfirmSubConcept').addEventListener('click', function() {
                if (!currentSelectedSubCard) return;

                const selectedId = currentSelectedSubCard.dataset.id;
                document.getElementById('selectedChiTietConcept').value = selectedId;

                document.querySelectorAll('.sub-concept-card').forEach(card => {
                    if (card.dataset.id !== selectedId) {
                        card.classList.add('hidden');
                    }
                });

                document.getElementById('confirmSubConceptBox').classList.add('hidden');
                const btnBack = document.getElementById('btnBackToSubConcepts');
                btnBack.classList.remove('hidden');
                btnBack.classList.add('flex');
            });

            document.getElementById('btnBackToSubConcepts').addEventListener('click', function() {
                const currentConceptId = document.getElementById('selectedConcept').value;
                resetSubConceptState(currentConceptId);
            });

            function resetSubConceptState(conceptId) {
                document.getElementById('selectedChiTietConcept').value = '';
                currentSelectedSubCard = null;

                document.querySelectorAll('.sub-concept-card').forEach(subCard => {
                    subCard.classList.remove('active');
                    if (subCard.dataset.parent === conceptId) {
                        subCard.classList.remove('hidden');
                    } else {
                        subCard.classList.add('hidden');
                    }
                });

                document.getElementById('confirmSubConceptBox').classList.add('hidden');
                const btnBack = document.getElementById('btnBackToSubConcepts');
                btnBack.classList.add('hidden');
                btnBack.classList.remove('flex');
            }

            // 4. Chọn Gói Dịch Vụ Chính
            let selectedServicePrice = 0;
            document.querySelectorAll('.service-pill').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.service-pill').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedServicePrice = parseInt(this.dataset.price) || 0;
                    document.getElementById('selectedService').value = this.dataset.id;
                    updateTotal();
                });
            });

            // 5. Xử lý Dịch Vụ Đi Kèm (Tăng giảm số lượng)
            document.querySelectorAll('.addon-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    const id = this.dataset.id;
                    const inputQty = document.getElementById(`input-qty-${id}`);
                    const qtyDisplay = document.getElementById(`qty-${id}`);

                    if (e.target.classList.contains('btn-minus')) {
                        e.stopPropagation();
                        let currentQty = parseInt(qtyDisplay.innerText) || 1;
                        if (currentQty > 1) {
                            currentQty--;
                            qtyDisplay.innerText = currentQty;
                            if (this.classList.contains('active')) {
                                inputQty.value = currentQty;
                            }
                        }
                        updateTotal();
                        return;
                    }

                    if (e.target.classList.contains('btn-plus')) {
                        e.stopPropagation();
                        let currentQty = parseInt(qtyDisplay.innerText) || 1;
                        currentQty++;
                        qtyDisplay.innerText = currentQty;
                        if (this.classList.contains('active')) {
                            inputQty.value = currentQty;
                        } else {
                            this.classList.add('active');
                            inputQty.value = currentQty;
                        }
                        updateTotal();
                        return;
                    }

                    if (this.classList.contains('active')) {
                        this.classList.remove('active');
                        inputQty.value = 0;
                    } else {
                        this.classList.add('active');
                        inputQty.value = parseInt(qtyDisplay.innerText) || 1;
                    }

                    updateTotal();
                });
            });

            // 6. Hàm Tính Tổng Tiền
            function updateTotal() {
                let addonsTotal = 0;
                document.querySelectorAll('.addon-qty-input').forEach(input => {
                    const qty = parseInt(input.value) || 0;
                    const price = parseInt(input.dataset.price) || 0;
                    addonsTotal += (qty * price);
                });
                const grandTotal = selectedServicePrice + addonsTotal;
                document.getElementById('totalDisplay').innerText = new Intl.NumberFormat('vi-VN').format(grandTotal) + ' VNĐ';
            }
        });
    </script>
</body>
</html>