<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $no_induk
 * @property string $nama
 * @property string $aktif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QHSInspectR> $inspectR
 * @property-read int|null $inspect_r_count
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspector query()
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspector whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspector whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QHSInspector whereNoInduk($value)
 * @mixin \Eloquent
 */
class QHSInspector extends Model
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
        return $this->hasMany(QHSInspectR::class, 'no_induk', 'no_induk');
    }
}
