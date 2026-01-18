<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_role
 * @property string $nama
 * @property string $aktif
 * @method static \Illuminate\Database\Eloquent\Builder|QHSRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSRole whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSRole whereKodeRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSRole whereNama($value)
 * @mixin \Eloquent
 */
class QHSRole extends Model
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
