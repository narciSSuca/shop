<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;
class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'uuid' => $this->uuid,
          'login' => $this->login,
          'password' => $this->password,
          'role_uuid' => $this->role_uuid,
          'role' => [
            'id' =>  $this->role->id,
            'uuid' =>  $this->role->uuid,
            'title' =>  $this->role->title,
          ],
          'profile' => new ProfileResource($this->profile),
        ];
    }
}
