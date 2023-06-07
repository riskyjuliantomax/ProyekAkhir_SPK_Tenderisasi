<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penilaian;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = "perusahaan";
    protected $primaryKey = "id_perusahaan";
    protected $fillable = [
        'id_perusahaan', 'nama_perusahaan', 'alamat_perusahaan', 'email_perusahaan', 'telp_perusahaan',
    ];

    public function Penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_perusahaan', 'id_perusahaan');
    }
}
