@extends('admin.layouts.master')

@section('title', 'Chi Tiết Concept - 22fotoholicstudio')

@section('content')
    <!-- Header Tiêu đề & Tổng số -->
    <header class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-base font-black uppercase tracking-wider text-gray-800 flex items-center">
                <i class="fa-solid fa-images text-teal-600 mr-2"></i> Chi Tiết Concept: <span class="text-purple-700 ml-1">{{ $conceptCha->TenConcept ?? '' }}</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Mã chủ đề: <span class="font-mono font-bold text-teal-600">#{{ $conceptCha->MaConcept ?? '' }}</span></p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-bold border border-teal-200">
                Tổng số: {{ $danhSachChiTietConcept->total() ?? 0 }} concept chi tiết
            </div>
            <!-- Nút Thêm Chi Tiết Concept -->
            <a href="{{ route('admin.chitietconcept.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Thêm Chi Tiết Concept
            </a>
        </div>
    </header>

    <!-- Bảng Dữ Liệu Chi Tiết Concept -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between mt-6">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-800">
                <i class="fa-solid fa-list mr-2 text-teal-600"></i> Danh Sách Chi Tiết Concept (`chitietconcept`)
            </h3>
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
                                <td class="p-4 font-bold text-gray-900 font-mono">#{{ $ct->MaChiTietConcept ?? '' }}</td>
                                <td class="p-4 text-purple-700 font-bold">{{ $ct->TenChiTietConcept ?? '' }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full text-[10px] font-bold">
                                        {{ $ct->TenConcept ?? 'Chưa phân loại' }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-600 max-w-xs truncate" title="{{ $ct->MoTa ?? '' }}">{{ $ct->MoTa ?? 'Không có mô tả' }}</td>
                                <td class="p-4 font-mono text-gray-500">{{ $ct->HinhAnh ?? 'N/A' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $ct->TrangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $ct->TrangThai == 1 ? 'Hoạt động' : 'Tạm ẩn' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1 flex justify-center items-center">
                                    <!-- Nút Sửa -->
                                    <a href="{{ route('admin.chitietconcept.edit', $ct->MaChiTietConcept) }}" class="px-3 py-1 bg-teal-50 text-teal-700 font-bold rounded-lg hover:bg-teal-100 transition inline-block">Sửa</a>
                                    
                                    <!-- Nút Xóa kèm hộp thoại xác nhận OK / Hủy -->
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
                            <td colspan="7" class="p-8 text-center text-gray-400 italic">Chưa có chi tiết concept nào thuộc chủ đề này.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Thanh chuyển trang căn giữa, ẩn text thừa -->
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center items-center" id="pagination-chitiet">
            <div class="flex justify-center w-full">
                {{ $danhSachChiTietConcept->links() }}
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nav = document.querySelector('#pagination-chitiet nav');
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