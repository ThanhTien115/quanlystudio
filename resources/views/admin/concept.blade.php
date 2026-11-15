@extends('admin.layouts.master')

@section('title', 'Quản Lý Concept & Chi Tiết - 22fotoholicstudio')

@section('content')
    <!-- Header Tiêu đề tổng quan -->
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-layer-group text-teal-600 mr-2"></i> QUẢN LÝ CONCEPT & CHI TIẾT
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Danh sách các danh mục concept chính và concept chi tiết tại studio</p>
        </div>
        <div class="flex items-center space-x-3 flex-wrap gap-2">
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-xl font-bold border border-teal-200">
                Concept chính: {{ $danhSachConcept->total() ?? 0 }} | Chi tiết: {{ $danhSachChiTietConcept->total() ?? 0 }}
            </div>
            <!-- Nút Thêm Concept Chính -->
            <a href="{{ route('admin.concept.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Thêm Danh Mục
            </a>
            <!-- Nút Thêm Chi Tiết Concept -->
            <a href="{{ route('admin.chitietconcept.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Thêm Chi Tiết
            </a>
        </div>
    </header>

    <!-- ================= 1. BẢNG DANH MỤC CONCEPT CHÍNH ================= -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <!-- Thanh Tìm kiếm và Lọc Concept Chính -->
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> 1. Danh Sách Danh Mục Concept Chính
            </h3>

            <form action="{{ route('admin.concept.index') }}" method="GET" class="flex items-center space-x-2 text-xs flex-wrap gap-2">
                <div class="relative">
                    <input type="text" name="tu_khoa_concept" value="{{ request('tu_khoa_concept') }}" placeholder="Tìm mã, tên concept..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 w-56 bg-white font-normal">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <select name="trang_thai_concept" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-teal-500 bg-white font-normal cursor-pointer">
                    <option value="">-- Trạng thái --</option>
                    <option value="1" {{ request('trang_thai_concept') === '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ request('trang_thai_concept') === '0' ? 'selected' : '' }}>Tạm ẩn</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-sm">
                    Tìm kiếm
                </button>

                @if(request()->filled('tu_khoa_concept') || request()->filled('trang_thai_concept'))
                    <a href="{{ route('admin.concept.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                        Đặt lại
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Concept</th>
                        <th class="p-4">Tên Concept</th>
                        <th class="p-4">Mô Tả</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachConcept) && count($danhSachConcept) > 0)
                        @foreach($danhSachConcept as $cpt)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $cpt->MaConcept }}</td>
                                <td class="p-4 font-bold text-purple-700">{{ $cpt->TenConcept }}</td>
                                <td class="p-4 text-gray-600">{{ $cpt->MoTa ?? 'Không có mô tả' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $cpt->TrangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $cpt->TrangThai == 1 ? 'Hoạt động' : 'Tạm ẩn' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <a href="{{ route('admin.concept.edit', $cpt->MaConcept) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    <form action="{{ route('admin.concept.destroy', $cpt->MaConcept) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có muốn xóa concept chính này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400 italic">Không tìm thấy danh mục concept chính nào.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang Concept chính -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center">
            {{ $danhSachConcept->appends(request()->except('page_cpt'))->links() }}
        </div>
    </div>


    <!-- ================= 2. BẢNG DANH SÁCH CHI TIẾT CONCEPT ================= -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
        <!-- Thanh Tìm kiếm và Lọc Chi Tiết Concept -->
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex flex-wrap justify-between items-center gap-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-list mr-2 text-purple-600"></i> 2. Danh Sách Chi Tiết Concept
            </h3>

            <form action="{{ route('admin.concept.index') }}" method="GET" class="flex items-center space-x-2 text-xs flex-wrap gap-2">
                <div class="relative">
                    <input type="text" name="tu_khoa_chitiet" value="{{ request('tu_khoa_chitiet') }}" placeholder="Tìm mã, tên chi tiết..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 w-56 bg-white font-normal">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <select name="trang_thai_chitiet" class="p-2 border border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 bg-white font-normal cursor-pointer">
                    <option value="">-- Trạng thái --</option>
                    <option value="1" {{ request('trang_thai_chitiet') === '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ request('trang_thai_chitiet') === '0' ? 'selected' : '' }}>Tạm ẩn</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl transition shadow-sm">
                    Tìm kiếm
                </button>

                @if(request()->filled('tu_khoa_chitiet') || request()->filled('trang_thai_chitiet'))
                    <a href="{{ route('admin.concept.index') }}" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                        Đặt lại
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider border-b border-gray-200">
                        <th class="p-4">Mã Chi Tiết</th>
                        <th class="p-4">Tên Concept Chi Tiết</th>
                        <th class="p-4">Thuộc Danh Mục Cha</th>
                        <th class="p-4">Mô Tả</th>
                        <th class="p-4">Ảnh File</th>
                        <th class="p-4 text-center">Trạng Thái</th>
                        <th class="p-4 text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @if(isset($danhSachChiTietConcept) && count($danhSachChiTietConcept) > 0)
                        @foreach($danhSachChiTietConcept as $ct)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $ct->MaChiTietConcept }}</td>
                                <td class="p-4 text-purple-700 font-bold">{{ $ct->TenChiTietConcept }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full text-[10px] font-bold">
                                        {{ $ct->TenConcept ?? 'Chưa phân loại' }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-600 max-w-xs truncate" title="{{ $ct->MoTa }}">{{ $ct->MoTa ?? 'Không có mô tả' }}</td>
                                <td class="p-4 font-mono text-gray-500">{{ $ct->HinhAnh ?? 'N/A' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $ct->TrangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $ct->TrangThai == 1 ? 'Hoạt động' : 'Tạm ẩn' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <a href="{{ route('admin.chitietconcept.edit', $ct->MaChiTietConcept) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    <form action="{{ route('admin.chitietconcept.destroy', $ct->MaChiTietConcept) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có muốn xóa chi tiết concept này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-700 font-bold rounded-lg hover:bg-rose-100 transition cursor-pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400 italic">Không tìm thấy chi tiết concept nào.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang Chi tiết Concept -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center">
            {{ $danhSachChiTietConcept->appends(request()->except('page_ct'))->links() }}
        </div>
    </div>
@endsection