@extends('admin.layouts.master')

@section('title', 'Quản Lý Đơn Đặt Lịch - 22fotoholicstudio')

@section('content')
    @if(session('success'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-2xl text-xs font-bold shadow-sm flex items-center mb-4">
            <i class="fa-solid fa-circle-check mr-2 text-sm"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-2xl text-xs font-bold shadow-sm flex items-center mb-4">
            <i class="fa-solid fa-triangle-exclamation mr-2 text-sm"></i> {{ $errors->first() }}
        </div>
    @endif

    <!-- Header trang quản lý & Các thống kê trạng thái -->
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-calendar-check text-teal-600 mr-2"></i> QUẢN LÝ ĐƠN ĐẶT LỊCH
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Danh sách toàn bộ các đơn đặt lịch chụp tại studio </p>
        </div>
        
        <!-- Các huy hiệu thống kê số lượng theo trạng thái -->
        <div class="flex flex-wrap items-center gap-2">
            <div class="text-[11px] bg-teal-50 text-teal-700 px-3 py-1.5 rounded-xl font-bold border border-teal-200 shadow-sm">
                Tổng: {{ $tongSoDon ?? 0 }}
            </div>
            <div class="text-[11px] bg-orange-50 text-orange-700 px-3 py-1.5 rounded-xl font-bold border border-orange-200 shadow-sm">
                Chờ TT: {{ $soChoThanhToan ?? 0 }}
            </div>
            <div class="text-[11px] bg-blue-50 text-blue-700 px-3 py-1.5 rounded-xl font-bold border border-blue-200 shadow-sm">
                Xác nhận: {{ $soDaXacNhan ?? 0 }}
            </div>
            <div class="text-[11px] bg-yellow-50 text-yellow-700 px-3 py-1.5 rounded-xl font-bold border border-yellow-200 shadow-sm">
                Đổi lịch: {{ $soDoiLich ?? 0 }}
            </div>
            <div class="text-[11px] bg-pink-50 text-pink-700 px-3 py-1.5 rounded-xl font-bold border border-pink-200 shadow-sm">
                Chấp nhận đổi: {{ $soChapNhanDoi ?? 0 }}
            </div>
            <div class="text-[11px] bg-red-50 text-red-700 px-3 py-1.5 rounded-xl font-bold border border-red-200 shadow-sm">
                YC Hủy: {{ $soYeuCauHuy ?? 0 }} | Hủy: {{ $soDaHuy ?? 0 }}
            </div>
            <div class="text-[11px] bg-green-50 text-green-700 px-3 py-1.5 rounded-xl font-bold border border-green-200 shadow-sm">
                Hoàn thành: {{ $soHoanThanh ?? 0 }}
            </div>
        </div>
    </header>

    <!-- Khung chứa bảng dữ liệu, tìm kiếm và phân trang -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between mt-6">
        
        <!-- Thanh Tìm kiếm và Lọc Trạng Thái -->
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Chi Tiết Đơn Đặt Lịch
            </h3>

            <form action="{{ route('admin.datlich.index') }}" method="GET" id="filter-form" class="flex items-center space-x-2 text-xs flex-wrap gap-2">
                <!-- Ô tìm kiếm theo Mã đơn hoặc Tên khách hàng -->
                <div class="relative">
                    <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="Tìm mã đơn, tên khách hàng..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 w-56 bg-white font-normal">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- THÊM: Ô chọn ngày chụp nằm cạnh thanh tìm kiếm -->
                <div>
                    <input type="date" name="ngay_chup" value="{{ request('ngay_chup') }}" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer" title="Lọc theo ngày chụp">
                </div>

                <!-- Dropdown lọc trạng thái -->
                <select name="trang_thai" onchange="document.getElementById('filter-form').submit();" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="Chờ thanh toán" {{ request('trang_thai') === 'Chờ thanh toán' ? 'selected' : '' }}>Chờ thanh toán</option>
                    <option value="Đã xác nhận" {{ request('trang_thai') === 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="Đang yêu cầu đổi lịch" {{ request('trang_thai') === 'Đang yêu cầu đổi lịch' ? 'selected' : '' }}>Đang yêu cầu đổi lịch</option>
                    <option value="Chấp nhận đổi lịch" {{ request('trang_thai') === 'Chấp nhận đổi lịch' ? 'selected' : '' }}>Chấp nhận đổi lịch</option>
                    <option value="Đang yêu cầu hủy" {{ request('trang_thai') === 'Đang yêu cầu hủy' ? 'selected' : '' }}>Đang yêu cầu hủy</option>
                    <option value="Đã hủy" {{ request('trang_thai') === 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    <option value="Đã hoàn thành" {{ request('trang_thai') === 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                </select>

                <!-- Nút Tìm kiếm -->
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm cursor-pointer">
                    Tìm kiếm
                </button>

                <!-- Nút Đặt lại nếu đang lọc/tìm -->
                @if(request()->filled('tu_khoa') || request()->filled('trang_thai') || request()->filled('ngay_chup'))
                    <a href="{{ route('admin.datlich.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                        Đặt lại
                    </a>
                @endif
            </form>
        </div>

        <!-- Bảng Dữ Liệu -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Đơn</th>
                        <th class="p-4">Khách Hàng</th>
                        <th class="p-4">Số Điện Thoại</th>
                        <th class="p-4">Gói Dịch Vụ</th>
                        <th class="p-4">Ngày Chụp</th> <!-- Cột Ngày Chụp mới thêm -->
                        <th class="p-4">Ngày Đặt</th>
                        <th class="p-4">Ngày Cập Nhật</th>
                        <th class="p-4">Ghi Chú</th>
                        <th class="p-4">Lý Do Từ Chối</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachDatLich) && count($danhSachDatLich) > 0)
                        @foreach($danhSachDatLich as $dl)
                            @php
                                $status = trim($dl->TrangThai);
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $dl->MaDatLich }}</td>
                                <td class="p-4 font-bold text-purple-700">{{ $dl->TenKhachHang ?? 'Khách lẻ' }}</td>
                                <td class="p-4 font-mono text-gray-600">{{ $dl->SoDienThoai ?? 'Chưa cập nhật' }}</td>
                                <td class="p-4 font-bold text-teal-600">{{ $dl->TenDichVu ?? 'Gói chụp tiêu chuẩn' }}</td>
                                
                                <!-- Hiển thị dữ liệu Ngày Chụp từ bảng lichchup -->
                                <td class="p-4 font-bold text-indigo-600 font-mono">
                                    {{ $dl->NgayChup ? date('d/m/Y', strtotime($dl->NgayChup)) : 'Chưa xếp lịch' }}
                                </td>

                                <td class="p-4 text-gray-500 font-mono">{{ $dl->NgayDat ? date('d/m/Y H:i', strtotime($dl->NgayDat)) : '-' }}</td>
                                <td class="p-4 text-gray-500 font-mono">{{ $dl->NgayCapNhat ? date('d/m/Y H:i', strtotime($dl->NgayCapNhat)) : '-' }}</td>
                                <td class="p-4 text-gray-600 max-w-xs truncate" title="{{ $dl->GhiChu }}">{{ $dl->GhiChu ?? '-' }}</td>
                                <td class="p-4 text-rose-600 max-w-xs truncate" title="{{ $dl->LyDoTuChoi }}">{{ $dl->LyDoTuChoi ?? '-' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold inline-block
                                        @if($status == 'Đã xác nhận') bg-blue-100 text-blue-700
                                        @elseif($status == 'Chờ thanh toán') bg-orange-100 text-orange-700
                                        @elseif($status == 'Đang yêu cầu đổi lịch') bg-yellow-100 text-yellow-700
                                        @elseif($status == 'Chấp nhận đổi lịch') bg-pink-100 text-pink-700
                                        @elseif($status == 'Đang yêu cầu hủy' || $status == 'Đã hủy') bg-red-100 text-red-700
                                        @elseif($status == 'Đã hoàn thành') bg-green-100 text-green-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ $dl->TrangThai }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <a href="{{ route('admin.datlich.edit', $dl->MaDatLich) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    <form action="{{ route('admin.datlich.destroy', $dl->MaDatLich) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn đặt lịch này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="p-8 text-center text-gray-400 italic">Không tìm thấy đơn đặt lịch nào phù hợp.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang căn giữa -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center" id="pagination-datlich">
            <div class="flex justify-center w-full">
                {{ $danhSachDatLich->links() }}
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nav = document.querySelector('#pagination-datlich nav');
                    if (nav) {
                        const firstChild = nav.querySelector('div:first-child');
                        if (firstChild && (firstChild.innerText.includes('Showing') || firstChild.innerText.includes('to'))) {
                            firstChild.remove();
                        }
                        nav.style.display = 'flex';
                        nav.style.justifyContent = 'center';
                        nav.style.width = '100%';
                    }
                });
            </script>
        </div>
    </div>
@endsection