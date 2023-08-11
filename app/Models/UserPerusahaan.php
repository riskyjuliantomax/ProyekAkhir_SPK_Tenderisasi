<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPerusahaan extends Model
{
    use HasFactory;
    protected $table = "user_perusahaans";
    protected $primaryKey = "id_users_perusahaan";
    protected $guarded = [];

    public function userPerusahaan()
    {
        return $this->hasOne(User::class, 'id_users', 'id_users');
    }
}
