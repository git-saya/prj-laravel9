<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 'API welcome';
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return new UserResource($request->user());
});

Route::post('sanctum/token', function (LoginRequest $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status'    => false,
            'messages'  => [
                'email' => ['The provided credentials are incorrect.']
            ]
        ], 422);
    }

    return response()->json([
        'status'    => true,
        'messages'  => 'Successfully',
        'user'      => $user,
        'token'     => $user->createToken('login')->plainTextToken
    ], 200);
});

Route::post('register', function (RegisterRequest $request) {
    $user = User::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => bcrypt($request->password)
    ]);

    $user_role = Role::where('name', 'User')->first();
    if ($user_role) :
        $user->assignRole($user_role);
    endif;

    #$token = $user->createToken('register')->plainTextToken;
    return new UserResource($user);
});

Route::post('user/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'status'    => true,
        'messages'  => 'deleted access token user'
    ], 201);
})->middleware('auth:sanctum');


Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
