<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penilaian;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = "perusahaan_dokumen";
    protected $primaryKey = "id_perusahaan";
    protected $guarded = [];

    public function Penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function infoTender()
    {
        return $this->hasOne(InfoTender::class, 'id_infoTender', 'id_infoTender');
    }
}
