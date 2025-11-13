<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qhs_kategori extends Model
{
    use HasFactory;

    protected $table = 'qhs-kategori';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
        'aktif'
    ];

    public function inspectD()
    {
        return $this->hasMany(qhs_inspect_d::class, 'kode', 'kode');
    }
}
