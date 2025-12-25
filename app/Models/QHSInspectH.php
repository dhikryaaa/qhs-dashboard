<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $no_dokumen
 * @property \Illuminate\Support\Carbon $tanggal
 * @property string $jam_mulai
 * @property string|null $jam_selesai
 * @property string $kode_dept
 * @property string|null $kode_lokasi
 * @property string $user_input
 * @property-read \App\Models\QHSDepartemen $departemen
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QHSInspectD> $inspectD
 * @property-read int|null $inspect_d_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QHSInspectR> $inspectR
 * @property-read int|null $inspect_r_count
 * @property-read \App\Models\QHSLokasi|null $lokasi
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereKodeDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereKodeLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectH whereUserInput($value)
 * @mixin \Eloquent
 */
class QHSInspectH extends Model
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
        return $this->belongsTo(QHSDepartemen::class, 'kode_dept', 'kode_dept');
    }

    public function lokasi()
    {
        return $this->belongsTo(QHSLokasi::class, 'kode_lokasi', 'kode_lokasi');
    }

    public function inspectR()
    {
        return $this->hasMany(QHSInspectR::class, 'no_dokumen', 'no_dokumen');
    }

    public function inspectD()
    {
        return $this->hasMany(QHSInspectD::class, 'no_dokumen', 'no_dokumen');
    }
}
