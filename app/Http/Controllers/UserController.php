<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\SetUserRequest;
use App\Models\User;
use App\Models\Profile;


class UserController extends Controller
{
    public function index(){
      return UserResource::collection(User::all());
    }

    public function store(SetUserRequest $request){
        $user = User::create([
          'uuid' => Str::uuid(),
          'login' => $request->login,
          'password' => Hash::make($request->password),
          'role_uuid' => $request->role_uuid
        ]);
        Profile::create([
            'uuid' => Str::uuid(),
            'user_uuid' => $user->uuid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $request->image
        ]);
        return new UserResource($user);
    }

    public function show($id){
        $user = User::findOrFail($id);
        $user = $user->role();
        return new UserResource($user);
    }

    public function update(SetUserRequest $request, $id){
        if($user = User::findOrFail($id)) {
          $user->update([
            'login' => $request->login,
            'password' => Hash::make($request->password)
          ]);

          $user->profile->update([
              'first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'patronymic' => $request->patronymic,
              'email' => $request->email,
              'phone' => $request->phone,
              'image' => $request->image
          ]);
        return new UserResource($user);
        }
    }

    public function destroy($id){
      $user = User::findOrFail($id);
      $user->delete();
      return 'Already';
    }



}
