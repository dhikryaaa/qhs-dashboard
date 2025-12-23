<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnArgument;

/**
 * @property string $no_dokumen
 * @property \Illuminate\Support\Carbon $tanggal
 * @property string $jam_mulai
 * @property string|null $jam_selesai
 * @property string $kode_dept
 * @property string|null $kode_lokasi
 * @property string $user_input
 * @property-read \App\Models\qhs_departemen $departemen
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\qhs_inspect_d> $inspectD
 * @property-read int|null $inspect_d_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\qhs_inspect_r> $inspectR
 * @property-read int|null $inspect_r_count
 * @property-read \App\Models\qhs_lokasi|null $lokasi
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereKodeDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereKodeLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_h whereUserInput($value)
 * @mixin \Eloquent
 */
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
