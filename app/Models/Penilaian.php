<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = "penilaian";
    protected $primaryKey = "id";
    protected $foreignKey = ["id_kriteria", "id_perusahaan"];
    protected $fillable = [
        'id_kriteria', 'id_perusahaan', 'nilai', 'created_at', 'updated_at'
    ];
    public function Penilaian()
    {
        return $this->hasOne(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
}
