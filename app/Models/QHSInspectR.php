<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $no_dokumen
 * @property string $tanggal
 * @property string $jam_mulai
 * @property string|null $jam_selesai
 * @property string $kode_dept
 * @property string|null $kode_lokasi
 * @property string $user_input
 * @property-read \App\Models\QHSInspectH|null $inspectH
 * @property-read \App\Models\QHSInspector|null $inspector
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereKodeDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereKodeLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectR whereUserInput($value)
 * @mixin \Eloquent
 */
class QHSInspectR extends Model
{
    use HasFactory;

    protected $table = 'qhs_inspect_h';
    protected $primaryKey = 'no_dokumen';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'no_dokumen',
        'no_induk'
    ];

    public function inspectH()
    {
        return $this->belongsTo(QHSInspectH::class, 'no_dokumen', 'no_dokumen');
    }

    public function inspector()
    {
        return $this->belongsTo(QHSInspector::class, 'no_induk', 'no_induk');
    }
}
