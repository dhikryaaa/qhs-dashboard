<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
