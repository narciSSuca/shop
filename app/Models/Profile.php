<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRoles;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
      'id',
      'uuid',
      'user_uuid',
      'first_name',
      'last_name',
      'patronymic',
      'email',
      'phone',
      'image',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
