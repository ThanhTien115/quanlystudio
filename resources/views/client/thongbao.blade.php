@extends('layouts.client')

@section('title', 'Thông Báo Hệ Thống - 22fotoholicstudio')

@section('content')

<style>
    body {
        background-color: #ece7ef !important; 
    }
</style>

<div class="max-w-4xl mx-auto pt-28 pb-12 px-4 text-gray-800">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
        
        <!-- Tiêu đề trang & Nút Quay lại trang chủ -->
        <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
            <h1 class="text-base font-black uppercase tracking-wider text-gray-900 flex items-center">
                <i class="fa-solid fa-bell text-teal-600 mr-2 text-lg"></i> Thông Báo Của Tôi
            </h1>
            <div class="flex items-center space-x-2">
                <a href="{{ route('client.home') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-3 py-1.5 rounded-xl transition shadow-sm flex items-center">
                    <i class="fa-solid fa-house mr-1.5 text-teal-600"></i> Trang chủ
                </a>
                <span class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-xl font-bold border border-teal-200 hidden sm:inline-block">
                    Hệ thống 22fotoholicstudio
                </span>
            </div>
        </div>

        <!-- Danh sách thông báo -->
        <div class="space-y-4">
            @forelse($danhSachThongBao as $tb)
                {{-- Kiểm tra linh hoạt cả dạng chữ ('Chưa đọc') lẫn dạng số (0) --}}
                @php
                    $isChuaDoc = ($tb->TrangThaiDoc == 'Chưa đọc' || $tb->TrangThaiDoc == 0);
                @endphp

                <div class="p-4 rounded-2xl border transition shadow-sm {{ $isChuaDoc ? 'bg-teal-50/50 border-teal-300' : 'bg-white border-gray-200 hover:border-gray-300' }}">
                    <div class="flex justify-between items-start gap-4">
                        <div class="space-y-1 flex-1">
                            <div class="flex items-center space-x-2">
                                @if($isChuaDoc)
                                    <span class="w-2.5 h-2.5 bg-rose-500 rounded-full inline-block animate-pulse"></span>
                                @endif
                                <h3 class="text-xs font-bold text-gray-900">
                                    {{ $tb->TieuDe ?? 'Thông báo hệ thống' }}
                                </h3>
                                <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $isChuaDoc ? 'bg-rose-100 text-rose-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $isChuaDoc ? 'Chưa đọc' : 'Đã đọc' }}
                                </span>
                            </div>
                            
                            <p class="text-xs text-gray-600 leading-relaxed pl-4">
                                {{ $tb->NoiDung }}
                            </p>
                            
                            <span class="text-[10px] text-gray-400 pl-4 block">
                                <i class="fa-regular fa-clock mr-1"></i> {{ date('d/m/Y H:i', strtotime($tb->ThoiGian ?? now())) }}
                            </span>
                        </div>

                        <!-- Nút thao tác Đã đọc / Chưa đọc -->
                        <div class="shrink-0">
                            <form action="{{ route('client.thongbao.toggle', $tb->MaThongBao) }}" method="POST">
                                @csrf
                                @if($isChuaDoc)
                                    <button type="submit" class="text-[11px] bg-teal-600 hover:bg-teal-700 text-white font-bold px-3 py-1.5 rounded-xl transition shadow-sm flex items-center cursor-pointer">
                                        <i class="fa-solid fa-check mr-1.5"></i> Đánh dấu đã đọc
                                    </button>
                                @else
                                    <button type="submit" class="text-[11px] bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-3 py-1.5 rounded-xl transition shadow-sm flex items-center cursor-pointer">
                                        <i class="fa-solid fa-rotate-left mr-1.5"></i> Đánh dấu chưa đọc
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-gray-400 italic text-xs">
                    <i class="fa-regular fa-bell-slash text-3xl mb-3 block text-gray-300"></i> Không có thông báo nào từ hệ thống.
                </div>
            @endforelse
        </div>

        <!-- Phân trang -->
        <div class="mt-6 flex justify-center">
            {{ $danhSachThongBao->links() }}
        </div>

    </div>
</div>
@endsection