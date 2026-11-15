<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    protected $table = 'concept';
    protected $primaryKey = 'MaConcept';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaConcept', 'TenConcept', 'MoTa', 'HinhAnh', 'TrangThai'];
}