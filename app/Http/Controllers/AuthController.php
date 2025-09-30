<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed', // gunakan password_confirmation di frontend
        'role_id' => 'required|integer'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => 2,
    ]);

    // generate token Sanctum
    $token = $user->createToken('sanctum')->plainTextToken;

    // kembalikan user + token
    return response([
        'data' => [
            'user' => $user,
            'token' => $token
        ]
    ]);
}

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        unset($user->email_verified_at);
        unset($user->created_at);
        unset($user->updated_at);
        unset($user->deleted_at);

        $user->tokens()->delete();
        $token = $user->createToken('sanctum')->plainTextToken;
        $user->token = $token;
        return response(['data' => $user]);

        // return $user->createToken('sanctum')->plainTextToken;
    
    
    }

    function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return response(['message' =>'logout success']);
    }

    public function me()
    {
        return (['data' =>(auth()->user())]);
    }
}
