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
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter whereBulan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter whereKonter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter whereNomor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_counter whereTahun($value)
 * @mixin \Eloquent
 */
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
