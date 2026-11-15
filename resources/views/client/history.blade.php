<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đặt Lịch - 22fotoholicstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-100/60 to-pink-100/50 text-gray-900 font-sans py-10 min-h-screen">

    <main class="max-w-7xl mx-auto px-4">
        <div class="bg-white/90 backdrop-blur-sm border border-purple-200/80 rounded-3xl shadow-xl p-6 sm:p-10 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-xs">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <header class="flex justify-between items-center border-b pb-4 border-gray-100">
                <div class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">LỊCH SỬ ĐẶT LỊCH CHỤP</h2>
                        <p class="text-xs text-gray-500 mt-1">Danh sách các buổi chụp ảnh bạn đã đăng ký tại 22fotoholicstudio</p>
                    </div>

                    <div class="flex items-center gap-3 shrink-0 ml-auto sm:ml-0">
                        <a href="{{ route('client.home') }}" class="inline-flex items-center text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 border border-gray-300 px-4 py-2 rounded-lg transition shadow-sm whitespace-nowrap">
                            <i class="fa-solid fa-house mr-1.5"></i> Quay lại trang chủ
                        </a>
                        <a href="{{ route('client.booking.form') }}" class="inline-flex items-center text-xs font-semibold text-white bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition shadow-sm whitespace-nowrap">
                            + Đặt lịch mới
                        </a>
                    </div>
                </div>
            </header>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-purple-50 text-purple-900 uppercase font-black tracking-wider border-b border-purple-100">
                            <th class="p-3">Mã đơn</th>
                            <th class="p-3">Gói & Concept</th>
                            <th class="p-3">Ngày & Khung giờ</th>
                            <th class="p-3">Tổng tiền</th>
                            <th class="p-3">Trạng thái cũ</th>
                            <th class="p-3">Trạng thái mới</th>
                            <th class="p-3">Ngày chụp sau thay đổi</th>
                            <th class="p-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($danhSachDatLich as $item)
                            @php
                                $statusCu = trim($item->TrangThaiCu);
                                $statusMoi = trim($item->TrangThaiMoi);
                            @endphp
                            <tr class="hover:bg-purple-50/30 transition">
                                <td class="p-3 font-bold text-gray-900">#{{ $item->MaDatLich }}</td>
                                <td class="p-3">
                                    <div class="font-bold text-gray-800">{{ $item->TenDichVu }}</div>
                                    <div class="text-[11px] text-purple-600 font-medium">{{ $item->TenConcept }}</div>
                                </td>
                                <td class="p-3">
                                    <div class="font-semibold text-gray-800">{{ $item->NgayChup ? date('d/m/Y', strtotime($item->NgayChup)) : 'Chưa có' }}</div>
                                    <div class="text-[11px] text-gray-500">{{ $item->GioBatDau }} - {{ $item->GioKetThuc }}</div>
                                </td>
                                <td class="p-3 font-bold text-gray-900">
                                    {{ number_format($item->TongTienPhaiTra ?? 0) }}đ
                                </td>

                                <!-- CỘT TRẠNG THÁI CŨ (Lấy trực tiếp từ bảng lichsudatlich) -->
                                <td class="p-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold inline-block bg-gray-100 text-gray-600">
                                        {{ $statusCu }}
                                    </span>
                                </td>

                                <!-- CỘT TRẠNG THÁI MỚI -->
                                <td class="p-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold inline-block
                                        @if($statusMoi == 'Đã xác nhận') bg-blue-100 text-blue-700
                                        @elseif($statusMoi == 'Chờ thanh toán') bg-orange-100 text-orange-700
                                        @elseif($statusMoi == 'Đang yêu cầu đổi lịch') bg-yellow-100 text-yellow-700
                                        @elseif($statusMoi == 'Chấp nhận đổi lịch') bg-pink-100 text-pink-700
                                        @elseif(str_contains($statusMoi, 'hủy')) bg-red-100 text-red-700
                                        @elseif($statusMoi == 'Đã hoàn thành') bg-green-100 text-green-700
                                        @else bg-purple-100 text-purple-700 @endif">
                                        {{ $statusMoi }}
                                    </span>
                                </td>

                                <!-- CỘT NGÀY CHỤP SAU THAY ĐỔI (Lấy từ NgayCapNhat trong bảng datlich) -->
                                <td class="p-3 font-semibold text-purple-700">
                                    {{ $item->NgayCapNhat ? date('d/m/Y H:i', strtotime($item->NgayCapNhat)) : 'Chưa thay đổi' }}
                                </td>

                                <!-- CỘT THAO TÁC (Giữ nguyên 2 nút Đổi lịch & Hủy lịch) -->
                                <td class="p-3 text-center space-x-1 whitespace-nowrap">
                                    <button onclick="openModal('changeModal{{ $item->MaDatLich }}')" class="bg-amber-500 hover:bg-amber-600 text-white px-2.5 py-1 rounded shadow text-[10px] font-semibold cursor-pointer">
                                        Đổi lịch
                                    </button>
                                    <button onclick="openModal('cancelModal{{ $item->MaDatLich }}')" class="bg-red-500 hover:bg-red-600 text-white px-2.5 py-1 rounded shadow text-[10px] font-semibold cursor-pointer">
                                        Hủy lịch
                                    </button>

                                    <!-- Modal Đổi Lịch -->
                                    <div id="changeModal{{ $item->MaDatLich }}" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 p-4">
                                        <div class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl space-y-4">
                                            <div class="flex justify-between items-center border-b pb-3">
                                                <h3 class="font-bold text-gray-800 text-sm">Yêu cầu đổi lịch: #{{ $item->MaDatLich }}</h3>
                                                <button onclick="closeModal('changeModal{{ $item->MaDatLich }}')" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                            <form action="{{ route('client.booking.requestChange', $item->MaDatLich) }}" method="POST" class="space-y-3">
                                                @csrf
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Chọn ngày chụp mới:</label>
                                                    <input type="date" name="NgayChupMoi" id="ngayChupMoi_{{ $item->MaDatLich }}" onchange="loadTimeSlots('{{ $item->MaDatLich }}')" class="w-full border rounded-lg p-2 text-xs focus:ring-2 focus:ring-purple-400 outline-none" required min="{{ date('Y-m-d') }}">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Chọn khung giờ mới:</label>
                                                    <select name="MaKhungGioMoi" id="selectKhungGio_{{ $item->MaDatLich }}" class="w-full border rounded-lg p-2 text-xs focus:ring-2 focus:ring-purple-400 outline-none bg-white" required>
                                                        <option value="">-- Vui lòng chọn ngày chụp trước --</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Lý do đổi lịch:</label>
                                                    <textarea name="LyDo" rows="3" class="w-full border rounded-lg p-2 text-xs focus:ring-2 focus:ring-purple-400 outline-none" placeholder="Nhập lý do thay đổi..." required></textarea>
                                                </div>
                                                <div class="flex justify-end gap-2 pt-2">
                                                    <button type="button" onclick="closeModal('changeModal{{ $item->MaDatLich }}')" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-semibold cursor-pointer">Đóng</button>
                                                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold cursor-pointer">Gửi yêu cầu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Hủy Lịch -->
                                    <div id="cancelModal{{ $item->MaDatLich }}" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 p-4">
                                        <div class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl space-y-4">
                                            <div class="flex justify-between items-center border-b pb-3">
                                                <h3 class="font-bold text-gray-800 text-sm">Yêu cầu hủy lịch: #{{ $item->MaDatLich }}</h3>
                                                <button onclick="closeModal('cancelModal{{ $item->MaDatLich }}')" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                            <form action="{{ route('client.booking.requestCancel', $item->MaDatLich) }}" method="POST" class="space-y-3">
                                                @csrf
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Lý do hủy lịch:</label>
                                                    <textarea name="LyDoHuy" rows="3" class="w-full border rounded-lg p-2 text-xs focus:ring-2 focus:ring-red-400 outline-none" placeholder="Nhập lý do bạn muốn hủy..." required></textarea>
                                                </div>
                                                <div class="flex justify-end gap-2 pt-2">
                                                    <button type="button" onclick="closeModal('cancelModal{{ $item->MaDatLich }}')" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-semibold cursor-pointer">Đóng</button>
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold cursor-pointer">Xác nhận hủy</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-gray-400">Bạn chưa có lịch chụp nào được đặt.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function loadTimeSlots(maDatLich) {
            let ngay = document.getElementById('ngayChupMoi_' + maDatLich).value;
            let selectBox = document.getElementById('selectKhungGio_' + maDatLich);

            if (!ngay) return;

            selectBox.innerHTML = '<option value="">Đang tải khung giờ...</option>';

            fetch(`/api/available-timeslots?ngay=${ngay}`)
                .then(response => response.json())
                .then(data => {
                    selectBox.innerHTML = '<option value="">-- Chọn khung giờ chụp --</option>';
                    if (data.length === 0) {
                        selectBox.innerHTML = '<option value="">Không có khung giờ trống</option>';
                        return;
                    }

                    data.forEach(slot => {
                        let option = document.createElement('option');
                        option.value = slot.MaKhungGio;
                        if (slot.ConTroong) {
                            option.textContent = `🟢 ${slot.TenHienThi} (Còn trống)`;
                        } else {
                            option.textContent = `🔴 ${slot.TenHienThi} (Đã kín)`;
                            option.disabled = true;
                            option.style.color = '#9ca3af';
                        }
                        selectBox.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Lỗi tải khung giờ:', error);
                    selectBox.innerHTML = '<option value="">Lỗi tải dữ liệu khung giờ</option>';
                });
        }
    </script>
</body>
</html>