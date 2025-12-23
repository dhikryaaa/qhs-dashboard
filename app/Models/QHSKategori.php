<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QHSInspectD> $inspectD
 * @property-read int|null $inspect_d_count
 * @method static \Illuminate\Database\Eloquent\Builder|QHSKategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSKategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSKategori query()
 * @mixin \Eloquent
 */
class QHSKategori extends Model
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
        return $this->hasMany(QHSInspectD::class, 'kode', 'kode');
    }
}
