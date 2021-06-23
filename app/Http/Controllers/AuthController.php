<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Profile;


class AuthController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
   public function __construct()
   {
       $this->middleware('auth:api', ['except' => ['login', 'registration']]);
   }

   /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function login()
   {

     $user = User::where('login', '123456')->where('password', '$2y$10$dwkonZR.LRUN7W.t.gkc9O1n4k8nvQKEs0KZe3ffYf426THsXjYGm')->first();
     $token = auth()->login($user);
     //   // $credentials = request(['password']);
     //   //
     //   // if (! $token = auth()->attempt($credentials)) {
     //   //     return response()->json(['error' => 'Unauthorized'], 401);
     //   // }
     //   //
     return $this->respondWithToken($token);
   }

    /**
     * User registration
     */
    public function registration(StoreUserRequest $request)
    {
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

        return 'Successfully registration!';
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return new UserResource(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
