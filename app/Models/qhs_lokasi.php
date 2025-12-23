<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_lokasi
 * @property string $nama_lokasi
 * @property string $aktif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\qhs_inspect_h> $inspectH
 * @property-read int|null $inspect_h_count
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_lokasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_lokasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_lokasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_lokasi whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_lokasi whereKodeLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_lokasi whereNamaLokasi($value)
 * @mixin \Eloquent
 */
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
