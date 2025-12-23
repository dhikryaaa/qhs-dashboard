<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\qhs_inspect_d> $inspectD
 * @property-read int|null $inspect_d_count
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_kategori query()
 * @mixin \Eloquent
 */
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
