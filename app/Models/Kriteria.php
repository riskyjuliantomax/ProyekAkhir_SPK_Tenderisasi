<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = "kriteria";
    protected $primaryKey = "id_kriteria";
    protected $fillable = [
        'id_kriteria', 'nama_kriteria', 'bobot', 'attribut', 'lock_kriteria'
    ];
    use Sortable;
    public $sortable = ['id_kriteria', 'nama_kriteria', 'bobot', 'attribut'];

    public function Crips()
    {
        return $this->hasMany(Crips::class, 'id_kriteria', 'id_kriteria');
    }
}
