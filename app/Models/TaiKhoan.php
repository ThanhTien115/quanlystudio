<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use Notifiable;

    protected $table = 'taikhoan';
    protected $primaryKey = 'MaTaiKhoan';
    public $incrementing = false; // MaTaiKhoan dạng string (TK001, TK002...)
    protected $keyType = 'string';

    // Tắt timestamps mặc định của Laravel (không dùng created_at & updated_at)
    public $timestamps = false; 

    protected $fillable = [
        'MaTaiKhoan',
        'TenDangNhap',
        'MatKhau',
        'TrangThaiHoatDong',
        'NgayTao',
        'LanDangNhapCuoi',
        'MaVaiTro'
    ];

    protected $hidden = [
        'MatKhau',
    ];

    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    public function khachHang()
    {
        return $this->hasOne(KhachHang::class, 'MaTaiKhoan', 'MaTaiKhoan');
    }
}