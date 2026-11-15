@extends('admin.layouts.master')

@section('title', 'Lịch Sử Đặt Lịch - 22fotoholicstudio')

@section('content')
    <!-- Header hiển thị thông tin khách hàng & Tổng số lịch sử -->
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-clock-rotate-left text-teal-600 mr-2"></i> Lịch Sử Đặt Lịch: <span class="text-purple-700 ml-1">{{ $khachHang->HoTen }}</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Số điện thoại: <span class="font-mono font-bold text-teal-600">{{ $khachHang->SoDienThoai }}</span> | Email: {{ $khachHang->Email }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <!-- Thêm tổng số lịch sử đặt lịch -->
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-bold border border-teal-200">
                Tổng lịch sử: {{ $danhSachLichSu->total() ?? 0 }}
            </div>
            <a href="{{ route('admin.khachhang.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center">
                <i class="fa-solid fa-arrow-left mr-1.5"></i> Quay lại danh sách
            </a>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Nhật Ký Hoạt Động & Lịch Sử (`lichsudatlich`)
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Lịch Sử</th>
                        <th class="p-4">Mã Đặt Lịch</th>
                        <th class="p-4">Hành Động</th>
                        <!-- Tách thành 2 cột riêng biệt -->
                        <th class="p-4">Trạng Thái Cũ</th>
                        <th class="p-4">Trạng Thái Mới</th>
                        <th class="p-4">Lý Do</th>
                        <th class="p-4">Ghi Chú</th>
                        <th class="p-4">Thời Gian Thao Tác</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachLichSu) && count($danhSachLichSu) > 0)
                        @foreach($danhSachLichSu as $ls)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $ls->MaLichSuDatLich }}</td>
                                <td class="p-4 font-bold font-mono text-teal-600">#{{ $ls->MaDatLich }}</td>
                                <td class="p-4 font-bold text-purple-700">{{ $ls->HanhDong }}</td>
                                
                                <!-- Cột Trạng Thái Cũ -->
                                <td class="p-4 text-gray-500">
                                    {{ $ls->TrangThaiCu ?? 'N/A' }}
                                </td>

                                <!-- Cột Trạng Thái Mới -->
                                <td class="p-4 font-bold text-teal-700">
                                    {{ $ls->TrangThaiMoi ?? 'N/A' }}
                                </td>

                                <td class="p-4 text-gray-700">{{ $ls->LyDo ?? 'Không có' }}</td>
                                <td class="p-4 text-gray-600">{{ $ls->GhiChu ?? 'Không có' }}</td>
                                <td class="p-4 font-mono text-gray-500">{{ $ls->ThoiGianThaoTac }}</td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <!-- Nút Sửa Lịch Sử -->
                                    <a href="{{ route('admin.lichsudatlich.edit', $ls->MaLichSuDatLich) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    
                                    <!-- Nút Xóa Lịch Sử kèm xác nhận -->
                                    <form action="{{ route('admin.lichsudatlich.destroy', $ls->MaLichSuDatLich) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa dòng lịch sử này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="p-8 text-center text-gray-400 italic">Khách hàng này chưa có lịch sử đặt lịch nào.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang căn giữa -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center" id="pagination-lichsu">
            <div class="flex justify-center w-full">
                {{ $danhSachLichSu->links() }}
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nav = document.querySelector('#pagination-lichsu nav');
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