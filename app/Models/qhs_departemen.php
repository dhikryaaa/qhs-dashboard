<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_dept
 * @property string $nama_dept
 * @property string $aktif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\qhs_inspect_h> $inspectH
 * @property-read int|null $inspect_h_count
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_departemen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_departemen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_departemen query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_departemen whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_departemen whereKodeDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_departemen whereNamaDept($value)
 * @mixin \Eloquent
 */
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
