<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnArgument;

class qhs_inspect_h extends Model
{
    use HasFactory;

    protected $table = 'qhs_inspect_h';
    protected $primaryKey = 'no_dokumen';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'no_dokumen',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kode_dept',
        'kode_lokasi',
        'user_input',
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function departemen()
    {
        return $this->belongsTo(qhs_departemen::class, 'kode_dept', 'kode_dept');
    }

    public function lokasi()
    {
        return $this->belongsTo(qhs_lokasi::class, 'kode_lokasi', 'kode_lokasi');
    }

    public function inspectR()
    {
        return $this->hasMany(qhs_inspect_r::class, 'no_dokumen', 'no_dokumen');
    }

    public function inspectD()
    {
        return $this->hasMany(qhs_inspect_d::class, 'no_dokumen', 'no_dokumen');
    }
}
