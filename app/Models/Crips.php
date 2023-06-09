<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crips extends Model
{
    use HasFactory;

    protected $table = "crips";
    protected $primaryKey = "id_crips";
    protected $guarded = [];

    public function Kriteria()
    {
        return $this->hasMany(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
