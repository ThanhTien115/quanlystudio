@extends('admin.layouts.master')

@section('title', 'Quản Lý Hóa Đơn - 22fotoholicstudio')

@section('content')
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-file-invoice-dollar text-teal-600 mr-2"></i> QUẢN LÝ HÓA ĐƠN & THANH TOÁN
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Danh sách toàn bộ các hóa đơn doanh thu tại studio</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-bold border border-teal-200">
                Tổng số hóa đơn: {{ $danhSachHoaDon->total() ?? 0 }}
            </div>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between mb-6">
        <!-- Thanh Tìm kiếm và Lọc Trạng Thái -->
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Hóa Đơn
            </h3>

            <form action="{{ route('admin.hoadon.index') }}" method="GET" id="filter-form" class="flex items-center space-x-2 text-xs">
                <!-- Ô tìm kiếm theo Mã hóa đơn hoặc Tên khách hàng -->
                <div class="relative">
                    <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="Tìm kiếm mã HĐ, tên khách hàng..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 w-64 bg-white font-normal">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Dropdown lọc trạng thái (Tự động submit khi thay đổi) -->
                <select name="trang_thai" onchange="document.getElementById('filter-form').submit();" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="Chờ thanh toán" {{ request('trang_thai') === 'Chờ thanh toán' ? 'selected' : '' }}>Chờ thanh toán</option>
                    <option value="Đã đặt cọc" {{ request('trang_thai') === 'Đã đặt cọc' ? 'selected' : '' }}>Đã đặt cọc</option>
                    <option value="Đã thanh toán" {{ request('trang_thai') === 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán</option>
                    <option value="Đã hủy" {{ request('trang_thai') === 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                </select>

                <!-- Nút Tìm kiếm -->
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm">
                    Tìm kiếm
                </button>

                <!-- Nút Đặt lại nếu đang tìm kiếm hoặc lọc -->
                @if(request()->filled('tu_khoa') || request()->filled('trang_thai'))
                    <a href="{{ route('admin.hoadon.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                        Đặt lại
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã HĐ</th>
                        <th class="p-4">Khách Hàng</th>
                        <th class="p-4">Mã Đặt Lịch</th>
                        <th class="p-4">Tổng Phải Trả</th>
                        <th class="p-4">Đã Thanh Toán</th>
                        <th class="p-4">Còn Lại</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachHoaDon) && count($danhSachHoaDon) > 0)
                        @foreach($danhSachHoaDon as $hd)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $hd->MaHoaDon }}</td>
                                <td class="p-4 font-bold text-purple-700">
                                    {{ $hd->TenKhachHang ?? 'Khách lẻ' }}<br>
                                    <span class="text-[10px] text-gray-400 font-mono">{{ $hd->SoDienThoai ?? $hd->MaKhachHang }}</span>
                                </td>
                                <td class="p-4 font-mono font-bold text-teal-600">#{{ $hd->MaDatLich }}</td>
                                <td class="p-4 font-bold font-mono">{{ number_format($hd->TongTienPhaiTra, 0, ',', '.') }} đ</td>
                                <td class="p-4 font-bold font-mono text-green-600">{{ number_format($hd->SoTienDaThanhToan, 0, ',', '.') }} đ</td>
                                <td class="p-4 font-bold font-mono text-rose-600">{{ number_format($hd->SoTienConLai, 0, ',', '.') }} đ</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold 
                                        {{ $hd->TrangThai == 'Đã thanh toán' ? 'bg-green-100 text-green-700' : ($hd->TrangThai == 'Đã đặt cọc' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700') }}">
                                        {{ $hd->TrangThai }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <a href="{{ route('admin.hoadon.edit', $hd->MaHoaDon) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    <form action="{{ route('admin.hoadon.destroy', $hd->MaHoaDon) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có muốn xóa hóa đơn này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="p-8 text-center text-gray-400 italic">Không tìm thấy hóa đơn nào phù hợp.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang căn giữa -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center" id="pagination-hoadon">
            <div class="flex justify-center w-full">
                {{ $danhSachHoaDon->links() }}
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nav = document.querySelector('#pagination-hoadon nav');
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