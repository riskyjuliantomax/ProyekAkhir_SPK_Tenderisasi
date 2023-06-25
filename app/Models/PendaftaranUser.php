<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranUser extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_users';
    protected $primaryKey = "id_pendaftaran_users";
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id_users', 'id_users');
    }

    public function infoTender()
    {
        return $this->hasOne(InfoTender::class, 'id_infoTender', 'id_infoTender');
    }
}
