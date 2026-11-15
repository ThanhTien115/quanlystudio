<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';
    public $incrementing = false; // MaKhachHang là varchar(10)
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaKhachHang',
        'HoTen',
        'NgaySinh',
        'GioiTinh',
        'SoDienThoai',
        'Email',
        'DiaChi',
        'TrangThai',
        'MaTaiKhoan'
    ];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTaiKhoan', 'MaTaiKhoan');
    }
}