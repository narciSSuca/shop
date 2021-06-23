<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\UserRoles;
use App\Models\Profile;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
      'id',
      'uuid',
      'login',
      'password',
      'role_uuid',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
      return $this->belongsTo(UserRoles::class, 'role_uuid','uuid');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_uuid','uuid');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}
