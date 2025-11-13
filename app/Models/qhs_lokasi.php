<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qhs_lokasi extends Model
{
    use HasFactory;

    protected $table = 'qhs_lokasi';
    protected $primaryKey = 'kode_lokasi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
        'aktif'
    ];

    public function inspectH() 
    {
        return $this->hasMany(qhs_inspect_h::class, 'kode_lokasi', 'kode_lokasi');
    }
}
