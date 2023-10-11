<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserAlamat;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Kyslik\ColumnSortable\Sortable;

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
    use Sortable;
    public $sortable = [
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
        'last_logout',
    ];
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
    public function userPerusahaan()
    {
        return $this->belongsTo(UserPerusahaan::class, 'id_users', 'id_users');
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "pokja", "admin"][$value],
        );
    }
}
