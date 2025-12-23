<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $no_induk
 * @property string $nama
 * @property string $aktif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\qhs_inspect_r> $inspectR
 * @property-read int|null $inspect_r_count
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspector query()
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspector whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspector whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|qhs_inspector whereNoInduk($value)
 * @mixin \Eloquent
 */
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
