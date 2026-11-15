@extends('admin.layouts.master') <!-- Tùy layout admin của bạn -->

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Quản lý Yêu Cầu Đổi / Hủy Lịch Từ Khách Hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Mã ĐL</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Dịch vụ</th>
                <th>Trạng thái hiện tại</th>
                <th>Ghi chú / Lý do từ khách</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($danhSachYeuCau as $yc)
            <tr>
                <td>{{ $yc->MaDatLich }}</td>
                <td>{{ $yc->TenKhachHang }}</td>
                <td>{{ $yc->SoDienThoai }}</td>
                <td>{{ $yc->TenDichVu }}</td>
                <td>
                    <span class="badge bg-warning text-dark">{{ $yc->TrangThai }}</span>
                </td>
                <td>{{ $yc->LyDoTuChoi ?? $yc->GhiChu }}</td>
                <td>
                    <form action="{{ route('admin.booking.processRequest', $yc->MaDatLich) }}" method="POST" class="d-flex gap-1">
                        @csrf
                        @if($yc->TrangThai == 'Đang yêu cầu đổi lịch')
                            <button type="submit" name="HanhDong" value="DuyetDoi" class="btn btn-sm btn-success">Duyệt đổi</button>
                            <button type="submit" name="HanhDong" value="TuChoiDoi" class="btn btn-sm btn-secondary">Từ chối đổi</button>
                        @elseif($yc->TrangThai == 'Đang yêu cầu hủy')
                            <button type="submit" name="HanhDong" value="DuyetHuy" class="btn btn-sm btn-danger">Duyệt hủy</button>
                            <button type="submit" name="HanhDong" value="TuChoiHuy" class="btn btn-sm btn-secondary">Từ chối hủy</button>
                        @endif
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Không có yêu cầu đổi/hủy nào đang chờ xử lý.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection