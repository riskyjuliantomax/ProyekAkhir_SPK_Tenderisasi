<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserAlamat;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $primaryKey = "id_users";
    protected $fillable = [
        'nama',
        'email',
        'tgl_lahir',
        'tempat_lahir',
        'img_profile',
        'role',
        'no_hp',
        'tentang',
        'created_at',
        'updated_at',
        'last_login',
        'last_logout'

    ];
    public $sortable = ['id_users', 'nama', 'email', 'role'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public function userAlamat()
    {
        return $this->belongsTo(UserAlamat::class, 'id_users', 'id_users');
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "pokja", "admin"][$value],
        );
    }
}
