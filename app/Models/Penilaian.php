<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Perusahaan;

class Penilaian extends Model
{

    protected $table = "penilaian";
    protected $primaryKey = "id_penilaian";
    protected $guarded = [];

    public function crips()
    {
        return $this->belongsTo(Crips::class, 'id_crips', 'id_crips');
    }
}
