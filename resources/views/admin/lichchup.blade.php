@extends('admin.layouts.master')

@section('title', 'Quản Lý Lịch Chụp - 22fotoholicstudio')

@section('content')
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-calendar-days text-teal-600 mr-2"></i> QUẢN LÝ LỊCH CHỤP ẢNH
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Danh sách toàn bộ lịch chụp tại studio</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-bold border border-teal-200">
                Tổng số: {{ $danhSachLichChup->total() ?? 0 }} lịch chụp
            </div>
            <a href="{{ route('admin.lichchup.them') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Thêm Lịch Chụp
            </a>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between mb-6">
        <!-- Thanh Tìm kiếm, Lọc Trạng Thái & Lọc Ngày Chụp -->
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Chi Tiết Lịch Chụp
            </h3>

            <form action="{{ route('admin.lichchup.index') }}" method="GET" id="filter-form" class="flex items-center space-x-2 text-xs">
                <!-- Ô tìm kiếm theo Mã lịch chụp -->
                <div class="relative">
                    <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="Nhập mã lịch chụp (VD: LC058)..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 w-52 bg-white font-normal">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Lọc theo 3 Trạng Thái (Tự động submit khi thay đổi) -->
                <select name="trang_thai" onchange="document.getElementById('filter-form').submit();" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="Đã đặt" {{ request('trang_thai') === 'Đã đặt'  }}>Đã đặt</option>
                    <option value="Còn trống" {{ request('trang_thai') === 'Còn trống' }}>Còn trống</option>
                    <option value="Tạm khóa" {{ request('trang_thai') === 'Tạm khóa'  }}>Tạm khóa</option>
                </select>

                <!-- Lọc theo Ngày Chụp (Tự động submit khi chọn ngày) -->
                <input type="date" name="ngay_chup" value="{{ request('ngay_chup') }}" onchange="document.getElementById('filter-form').submit();" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer">

                <!-- Nút Tìm kiếm -->
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm">
                    Tìm kiếm
                </button>

                <!-- Nút Đặt lại nếu đang có điều kiện lọc/tìm -->
                @if(request()->filled('tu_khoa') || request()->filled('trang_thai') || request()->filled('ngay_chup'))
                    <a href="{{ route('admin.lichchup.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                        Đặt lại
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Lịch Chụp</th>
                        <th class="p-4">Ngày Chụp</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4">Ghi Chú</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachLichChup) && count($danhSachLichChup) > 0)
                        @foreach($danhSachLichChup as $lc)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $lc->MaLichChup }}</td>
                                <td class="p-4 font-mono font-bold text-teal-600">{{ date('d/m/Y', strtotime($lc->NgayChup)) }}</td>
                                <td class="p-4 text-center">
                                    @php
                                        $status = trim($lc->TrangThai);
                                        // Quy định màu sắc theo 3 trạng thái
                                        $badgeClass = 'bg-gray-100 text-gray-600';
                                        if ($status == 'Đã đặt' || $status == 'DaDat') {
                                            $badgeClass = 'bg-green-100 text-green-700'; // Xanh lá
                                        } elseif ($status == 'Còn trống' || $status == 'ConTrong') {
                                            $badgeClass = 'bg-blue-100 text-blue-700';   // Xanh dương
                                        } elseif ($status == 'Tạm khóa' || $status == 'TamKhoa') {
                                            $badgeClass = 'bg-rose-100 text-rose-700';   // Đỏ
                                        }
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $badgeClass }}">
                                        {{ $lc->TrangThai }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-600">{{ $lc->GhiChu ?? 'Không có' }}</td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <a href="{{ route('admin.lichchup.edit', $lc->MaLichChup) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    <form action="{{ route('admin.lichchup.destroy', $lc->MaLichChup) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có muốn xóa lịch chụp này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400 italic">Không tìm thấy lịch chụp nào phù hợp.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang căn giữa -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center" id="pagination-lichchup">
            <div class="flex justify-center w-full">
                {{ $danhSachLichChup->links() }}
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nav = document.querySelector('#pagination-lichchup nav');
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