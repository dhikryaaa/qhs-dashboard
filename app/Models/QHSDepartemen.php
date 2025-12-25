<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_dept
 * @property string $nama_dept
 * @property string $aktif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QHSInspectH> $inspectH
 * @property-read int|null $inspect_h_count
 * @method static \Illuminate\Database\Eloquent\Builder|QHSDepartemen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSDepartemen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSDepartemen query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSDepartemen whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSDepartemen whereKodeDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSDepartemen whereNamaDept($value)
 * @mixin \Eloquent
 */
class QHSDepartemen extends Model
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
        return $this->hasMany(QHSInspectH::class, 'kode_dept', 'kode_dept');
    }
}
