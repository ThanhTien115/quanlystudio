<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DichVuDiKem extends Model
{
    protected $table = 'dichvudikem';
    protected $primaryKey = 'MaDichVuDiKem';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaDichVuDiKem', 'TenDichVuDiKem', 'MoTa', 'DonGia', 'DonViTinh', 'TrangThai'];
}