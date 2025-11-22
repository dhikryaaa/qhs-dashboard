<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qhs_departemen extends Model
{
    use HasFactory;
    
    protected $table = 'qhs_departemen';
    protected $primaryKey = 'kode_dept';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_dept',
        'nama_dept',
        'aktif'
    ];

    public function inspectH()
    {
        return $this->hasMany(qhs_inspect_h::class, 'kode_dept', 'kode_dept');
    }
}
