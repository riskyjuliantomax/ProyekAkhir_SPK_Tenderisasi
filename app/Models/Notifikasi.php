<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasi';
    protected $primaryKey = "id_notifikasi";
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id_users', 'id_users');
    }
}
