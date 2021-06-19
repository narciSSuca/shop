<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRoles;

class UserRoles extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
      'id',
      'uuid',
      'title',
    ];

    public function users(){
        return $this->hasMany(User::class,'role_uuid','uuid');
    }
}
