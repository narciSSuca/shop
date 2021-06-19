<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserRolesResource extends JsonResource
{
    function toArray($request)
    {
        return [
          'id' => $this->id,
          'uuid' => $this->uuid,
          'title' => $this->title,
          'users' => UserResource::collection($this->users),
        ];
    }
}
