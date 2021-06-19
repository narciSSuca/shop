<?php

namespace App\Models;

use App\Models\UserRoles;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
      'id',
      'uuid',
      'login',
      'password',
      'role_uuid',
    ];

    public function role()
    {
      return $this->belongsTo(UserRoles::class, 'role_uuid','uuid');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_uuid','uuid');
    }



}
