<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    protected $table = 'dichvu';
    protected $primaryKey = 'MaDichVu';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaDichVu', 'TenDichVu', 'MoTa', 'DonGia', 'ThoiLuongDuKien', 'SoNguoiToiDa', 'TrangThai'];
}