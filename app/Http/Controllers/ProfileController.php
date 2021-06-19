<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {
      return ProfileResource::collection(Profile::all());
    }

    public function store(StoreProfileRequest $request)
    {
        $pathImage = "storage/". $request->file('image')->store('uploads/image','public');
        $profile = Profile::create([
          'uuid' =>  Str::uuid(),
          'user_uuid' => $request->user_uuid,
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'patronymic' => $request->patronymic,
          'email' => $request->email,
          'phone' => $request->phone,
          'image' => $pathImage
        ]);
        return new ProfileResource($profile);
    }

    public function show($id)
    {
      $profile = Profile::find($id);
      return new ProfileResource($profile);
    }

    public function update(UpdateProfileRequest $request, $id)
    {
      if($profile = Profile::findOrFail($id)) {
        $profile->update([
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'patronymic' => $request->patronymic,
          'email' => $request->email,
          'phone' => $request->phone,
          'image' => $request->image
        ]);
      return new ProfileResource($roles);
      }
    }

    public function destroy($id){
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return 'Already';
    }
}
