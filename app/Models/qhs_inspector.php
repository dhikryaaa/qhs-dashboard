<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qhs_inspector extends Model
{
    use HasFactory;

    protected $table = 'qhs_inspector';
    protected $primaryKey = 'no_induk';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'no_induk',
        'nama',
        'aktif'
    ];

    public function inspectR()
    {
        return $this->hasMany(qhs_inspect_r::class, 'no_induk', 'no_induk');
    }
}
