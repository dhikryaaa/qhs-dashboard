<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qhs_role extends Model
{
    use HasFactory;

    protected $table = 'qhs_role';
    protected $primaryKey = 'kode_role';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_role',
        'nama',
        'aktif'
    ];
}
