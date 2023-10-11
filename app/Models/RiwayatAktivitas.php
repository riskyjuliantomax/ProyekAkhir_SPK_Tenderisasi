<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAktivitas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "riwayat_aktivitas";
    protected $primaryKey = "id_riwayat_aktivitas";
    protected $fillable = [
        'id_riwayat_aktivitas', 'id_users', 'deskripsi', 'deskripsi2', 'deskripsi3', 'waktu', 'role'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
