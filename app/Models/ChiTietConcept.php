<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietConcept extends Model
{
    protected $table = 'chitietconcept';
    protected $primaryKey = 'MaChiTietConcept';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaChiTietConcept', 
        'TenChiTietConcept', 
        'MoTa', 
        'HinhAnh', 
        'TrangThai', 
        'MaConcept'
    ];

    // Quan hệ N-1: 1 ChiTietConcept thuộc về 1 Concept chính
    public function concept()
    {
        return $this->belongsTo(Concept::class, 'MaConcept', 'MaConcept');
    }
}