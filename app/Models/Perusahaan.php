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
        'id_perusahaan', 'nama_perusahaan', 'alamat_perusahaan', 'email_perusahaan', 'telp_perusahaan', 'id_users', 'tahun_berdiri', 'nama_kontak', 'harga_penawaran', 'dokumen_penawaran'
    ];

    public function Penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_perusahaan', 'id_perusahaan');
    }
}
