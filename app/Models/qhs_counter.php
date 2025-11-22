<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qhs_counter extends Model
{
    use HasFactory;

    protected $table = 'qhs_counter';
    protected $primaryKey = ['kode', 'bulan', 'tahun', 'konter'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'bulan',
        'tahun',
        'konter',
        'nomor'
    ];

    protected $casts = [
        'tahun' => 'integer',
        'konter' => 'integer'
    ];
}
