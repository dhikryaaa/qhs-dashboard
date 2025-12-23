<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_role
 * @property string $nama
 * @property string $aktif
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_role query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_role whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_role whereKodeRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_role whereNama($value)
 * @mixin \Eloquent
 */
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
