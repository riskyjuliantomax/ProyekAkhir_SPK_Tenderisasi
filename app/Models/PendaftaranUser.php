<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PendaftaranUser extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_users';
    protected $primaryKey = "id_pendaftaran_users";
    protected $guarded = [];
    use Sortable;
    public $sortable = [
        'id_users', 'id_infoTender', 'nama_perusahaan', 'alamat_perusahaan', 'tahun_berdiri', 'nama_kontak', 'harga_penawaran',
        'telp_perusahaan', 'email_perusahaan'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_users', 'id_users');
    }

    public function infoTender()
    {
        return $this->hasOne(InfoTender::class, 'id_infoTender', 'id_infoTender');
    }
}
