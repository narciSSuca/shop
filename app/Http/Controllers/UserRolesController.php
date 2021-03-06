<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserRoles as Roles;
use App\Http\Resources\UserRolesResource;
use App\Http\Requests\UpdateRolesleRequest;
use App\Http\Requests\StoreRolesRequest;

class UserRolesController extends Controller
{
    public function index(){
      return UserRolesResource::collection(Roles::all());
    }

    public function store(StoreRolesRequest $request){
        $roles = Roles::create([
          'title' => $request->title,
          'uuid' => Str::uuid()
        ]);
        return new UserRolesResource($roles);
    }

    public function show($id){
        $roles = Roles::find($id);
        return new UserRolesResource($roles);
    }

    public function update(UpdateRolesRequestt $request, $id){
        if($roles = Roles::findOrFail($id)) {
          $roles->update([
            'title' => $request->title
          ]);
        return new UserRolesResource($roles);
        }
    }

    public function destroy($id){
      $roles = Roles::findOrFail($id);
      $roles->delete();
      return 'Already';
    }
}
