<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $no_dokumen
 * @property int $sub
 * @property string|null $kode
 * @property string $bukti_temuan
 * @property string $deskripsi
 * @property string|null $dokumen
 * @property string|null $referensi
 * @property string|null $saran_koreksi
 * @property string|null $saran_korektif
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $tgl_perbaikan
 * @property string|null $bukti_perbaikan
 * @property \Illuminate\Support\Carbon|null $tgl_close
 * @property string|null $user_close
 * @property-read \App\Models\QHSInspectH $inspectH
 * @property-read \App\Models\QHSKategori|null $kategori
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereBuktiPerbaikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereBuktiTemuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereReferensi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereSaranKoreksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereSaranKorektif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereTglClose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereTglPerbaikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspectD whereUserClose($value)
 * @mixin \Eloquent
 */
class QHSInspectD extends Model
{
    use HasFactory;

    protected $table = 'qhs_inspect_d';
    protected $primaryKey = ['no_dokumen', 'sub'];
    public $incrementing = false;
    public $timestamps = false;
    
    
    protected $fillable = [
        'no_dokumen',
        'sub',
        'kode',
        'bukti_temuan',
        'deskripsi',
        'dokumen',
        'referensi',
        'saran_koreksi',
        'saran_korektif',
        'status',
        'tgl_perbaikan',
        'bukti_perbaikan',
        'tgl_close',
        'user_close',
    ];
    
    protected $casts = [
        'sub' => 'integer',
        'tgl_perbaikan' => 'date',
        'tgl_close' => 'date',
    ];

    public function inspectH()
    {
        return $this->belongsTo(QHSInspectH::class, 'no_dokumen', 'no_dokumen');
    }

    public function kategori()
    {
        return $this->belongsTo(QHSKategori::class, 'kode', 'kode');
    }
}
