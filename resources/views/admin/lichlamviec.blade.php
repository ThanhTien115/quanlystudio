@extends('admin.layouts.master')

@section('title', 'Quản Lý Lịch Làm Việc - 22fotoholicstudio')

@section('content')
    @if(session('success'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-2xl text-xs font-bold shadow-sm mb-4">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-calendar-days text-teal-600 mr-2"></i> QUẢN LÝ LỊCH LÀM VIỆC
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Danh sách toàn bộ lịch làm việc của nhân sự / studio</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-2 rounded-xl font-bold border border-teal-200 shadow-sm">
                Tổng số: {{ $danhSachLichLamViec->total() }} lịch
            </div>
            <a href="{{ route('admin.lichlamviec.them') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm">
                + Thêm Lịch Làm Việc
            </a>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Lịch Làm Việc
            </h3>

            <form action="{{ route('admin.lichlamviec.index') }}" method="GET" class="flex items-center space-x-2 text-xs">
                <div class="relative">
                    <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="Tìm mã lịch làm việc..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 w-56 bg-white">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <select name="trang_thai" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white cursor-pointer">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>Tạm khóa</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm">Tìm kiếm</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Lịch</th>
                        <th class="p-4">Ngày Làm Việc</th>
                        <th class="p-4">Loại Ngày</th>
                        <th class="p-4">Thời Gian</th>
                        <th class="p-4">Ghi Chú</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @forelse($danhSachLichLamViec as $llv)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-gray-900 font-mono">#{{ $llv->MaLichLamViec }}</td>
                            <td class="p-4 font-bold text-teal-600">{{ date('d/m/Y', strtotime($llv->NgayLamViec)) }}</td>
                            <td class="p-4 text-gray-700 font-semibold">{{ $llv->LoaiNgay ?? 'Ngày thường' }}</td>
                            <td class="p-4 text-gray-700">
                                <span class="text-teal-700 font-semibold">{{ $llv->GioMoCua ?? '--:--' }}</span> - 
                                <span class="text-purple-700 font-semibold">{{ $llv->GioDongCua ?? '--:--' }}</span>
                            </td>
                            <td class="p-4 text-gray-500 max-w-xs truncate">{{ $llv->GhiChu ?? 'Không có' }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold inline-block {{ $llv->TrangThaiLamViec == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $llv->TrangThaiLamViec == 1 ? 'Hoạt động' : 'Tạm khóa' }}
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-1">
                                <a href="{{ route('admin.lichlamviec.edit', $llv->MaLichLamViec) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                <form action="{{ route('admin.lichlamviec.destroy', $llv->MaLichLamViec) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa lịch làm việc này?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400 italic">Không tìm thấy lịch làm việc nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center">
            {{ $danhSachLichLamViec->links() }}
        </div>
    </div>
@endsection