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
 * @property-read \App\Models\qhs_inspect_h $inspectH
 * @property-read \App\Models\qhs_kategori|null $kategori
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereBuktiPerbaikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereBuktiTemuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereReferensi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereSaranKoreksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereSaranKorektif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereTglClose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereTglPerbaikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspect_d whereUserClose($value)
 * @mixin \Eloquent
 */
class qhs_inspect_d extends Model
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
        return $this->belongsTo(qhs_inspect_h::class, 'no_dokumen', 'no_dokumen');
    }

    public function kategori()
    {
        return $this->belongsTo(qhs_kategori::class, 'kode', 'kode');
    }
}
