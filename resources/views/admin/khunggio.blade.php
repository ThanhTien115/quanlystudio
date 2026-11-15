@extends('admin.layouts.master')

@section('title', 'Quản Lý Khung Giờ Làm Việc - 22fotoholicstudio')

@section('content')
    @if(session('success'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-2xl text-xs font-bold shadow-sm mb-4">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-clock text-teal-600 mr-2"></i> QUẢN LÝ KHUNG GIỜ & CA LÀM VIỆC
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Cấu hình các khung giờ phục vụ chụp ảnh cho khách hàng tại studio</p>
        </div>
        <a href="{{ route('admin.khunggio.them') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm cursor-pointer">
            + Thêm Khung Giờ Mới
        </a>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Khung Giờ Hoạt Động
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Khung Giờ</th>
                        <th class="p-4">Giờ Bắt Đầu</th>
                        <th class="p-4">Giờ Kết Thúc</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @forelse($danhSachKhungGio as $kg)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-gray-900 font-mono">#{{ $kg->MaKhungGio }}</td>
                            <td class="p-4 font-bold text-teal-600"><i class="fa-regular fa-clock mr-1"></i> {{ $kg->GioBatDau }}</td>
                            <td class="p-4 font-bold text-purple-600"><i class="fa-regular fa-clock mr-1"></i> {{ $kg->GioKetThuc }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold inline-block bg-green-100 text-green-700">
                                    {{ $kg->TrangThai ?? 'Hoạt động' }}
                                </span>
                            </td>
                            
                            <td class="p-4 text-center space-x-1">
                                <!-- Nút Sửa -->
                                <a href="{{ route('admin.khunggio.edit', $kg->MaKhungGio) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                
                                <!-- Nút Xóa -->
                                <form action="{{ route('admin.khunggio.destroy', $kg->MaKhungGio) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khung giờ này?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400 italic">Chưa có khung giờ làm việc nào được cấu hình.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center">
            {{ $danhSachKhungGio->links() }}
        </div>
    </div>
@endsection