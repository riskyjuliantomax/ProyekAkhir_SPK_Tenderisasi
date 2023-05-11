<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlamat extends Model
{
    use HasFactory;

    protected $table = "user_alamat";
    protected $primaryKey = "id_useralamat";
    protected $foreignKey = "id_users";
    protected $fillable = [
        'id_useralamat', 'id_users', 'kenegaraan', 'provinsi', 'kabupaten', 'kota', 'alamat', 'kecamatan', 'kodepos'
    ];
}
