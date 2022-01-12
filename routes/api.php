<?php

use cactu\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/login',function(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user) {
        throw ValidationException::withMessages(['Usuario no existe']);

    }else if(! Hash::check($request->password, $user->password)){
        throw ValidationException::withMessages(['Contraseña incorrecta']);
    }
    $tk=$user->createToken($user->identificacion)->plainTextToken;
    $data = array(
        'ok'=>'ok',
        'id'=>$user->id,
        'email' => $user->email,
        'name'=>$user->name,
        'token'=>$tk
    );
    return response()->json($data);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return User::all();
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
