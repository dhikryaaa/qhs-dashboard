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
 * @property-read \App\Models\qhs_inspect_h|null $inspectH
 * @property-read \App\Models\qhs_inspector|null $inspector
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereKodeDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereKodeLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_r whereUserInput($value)
 * @mixin \Eloquent
 */
class qhs_inspect_r extends Model
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
        return $this->belongsTo(qhs_inspect_h::class, 'no_dokumen', 'no_dokumen');
    }

    public function inspector()
    {
        return $this->belongsTo(qhs_inspector::class, 'no_induk', 'no_induk');
    }
}
