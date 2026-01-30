<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_lokasi
 * @property string $nama_lokasi
 * @property string $aktif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QHSInspectH> $inspectH
 * @property-read int|null $inspect_h_count
 * @method static \Illuminate\Database\Eloquent\Builder|QHSLokasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSLokasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSLokasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSLokasi whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSLokasi whereKodeLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSLokasi whereNamaLokasi($value)
 * @mixin \Eloquent
 */
class QHSLokasi extends Model
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
        return $this->hasMany(QHSInspectH::class, 'kode_lokasi', 'kode_lokasi');
    }
}
