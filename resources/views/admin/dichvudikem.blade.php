@extends('admin.layouts.master')

@section('title', 'Quản Lý Dịch Vụ Đi Kèm - 22fotoholicstudio')

@section('content')
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-puzzle-piece text-teal-600 mr-2"></i> QUẢN LÝ DỊCH VỤ ĐI KÈM / ADD-ONS
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Danh sách toàn bộ các dịch vụ đi kèm, add-ons tại studio </p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-bold border border-teal-200">
                Tổng số add-on: {{ $danhSachAddOns->total() ?? 0 }}
            </div>
            <a href="{{ route('admin.dichvudikem.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Thêm Add-on Mới
            </a>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between mb-6">
        <!-- Thanh Tìm kiếm và Lọc trạng thái -->
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Dịch Vụ Đi Kèm / Add-ons 
            </h3>

            <form action="{{ route('admin.dichvudikem.index') }}" method="GET" id="filter-form" class="flex items-center space-x-2 text-xs">
                <!-- Ô tìm kiếm theo Mã hoặc Tên Add-on -->
                <div class="relative">
                    <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="Tìm mã add-on, tên dịch vụ..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 w-64 bg-white font-normal">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Lọc theo Trạng Thái (Tự động submit khi thay đổi lựa chọn) -->
                <select name="trang_thai" onchange="document.getElementById('filter-form').submit();" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>Tạm ẩn</option>
                </select>

                <!-- Nút Tìm kiếm -->
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm">
                    Tìm kiếm
                </button>

                <!-- Nút Đặt lại nếu đang có điều kiện lọc/tìm -->
                @if(request()->filled('tu_khoa') || request()->filled('trang_thai'))
                    <a href="{{ route('admin.dichvudikem.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                        Đặt lại
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Add-on</th>
                        <th class="p-4">Tên Dịch Vụ Đi Kèm</th>
                        <th class="p-4">Đơn Giá (VNĐ)</th>
                        <th class="p-4">Mô Tả</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachAddOns) && count($danhSachAddOns) > 0)
                        @foreach($danhSachAddOns as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $item->MaDvDiKem }}</td>
                                <td class="p-4 font-bold text-purple-700">{{ $item->TenDvDiKem }}</td>
                                <td class="p-4 font-bold font-mono text-teal-600">{{ number_format($item->DonGia, 0, ',', '.') }} đ</td>
                                <td class="p-4 text-gray-600">{{ $item->MoTa ?? 'Không có mô tả' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $item->TrangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $item->TrangThai == 1 ? 'Hoạt động' : 'Tạm ẩn' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <a href="{{ route('admin.dichvudikem.edit', $item->MaDvDiKem) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    <form action="{{ route('admin.dichvudikem.destroy', $item->MaDvDiKem) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có muốn xóa dịch vụ đi kèm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400 italic">Không tìm thấy dịch vụ đi kèm nào phù hợp.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang căn giữa -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center" id="pagination-addons">
            <div class="flex justify-center w-full">
                {{ $danhSachAddOns->links() }}
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nav = document.querySelector('#pagination-addons nav');
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