<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
