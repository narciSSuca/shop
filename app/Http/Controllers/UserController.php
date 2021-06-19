<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Profile;


class UserController extends Controller
{
    public function index(){
      return UserResource::collection(User::all());
    }

    public function store(StoreUserRequest $request){
        $user = User::create([
          'uuid' => Str::uuid(),
          'login' => $request->login,
          'password' => Hash::make($request->password),
          'role_uuid' => $request->role_uuid
        ]);
        $pathImage = "storage/". $request->file('image')->store('uploads/image','public');
        Profile::create([
            'uuid' => Str::uuid(),
            'user_uuid' => $user->uuid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $pathImage
        ]);
        return new UserResource($user);
        dd($pathImage);
    }

    public function show($id){
        $user = User::findOrFail($id);
        $user = $user->role();
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, $id){
        if($user = User::findOrFail($id)) {
          $user->update([
            'role_uuid' => $request->role_uuid,
            'login' => $request->login,
            'password' => Hash::make($request->password)
          ]);
          $pathImage = "storage/". $request->file('image')->store('uploads/image','public');
          $user->profile->update([
              'first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'patronymic' => $request->patronymic,
              'email' => $request->email,
              'phone' => $request->phone,
              'image' => $pathImage
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
