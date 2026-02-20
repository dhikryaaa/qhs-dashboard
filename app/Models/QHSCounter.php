<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode
 * @property string $bulan
 * @property int $tahun
 * @property int $konter
 * @property string $nomor
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter whereBulan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter whereKonter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter whereNomor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSCounter whereTahun($value)
 * @mixin \Eloquent
 */
class QHSCounter extends Model
{
    use HasFactory;

    protected $table = 'qhs_counter';
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
