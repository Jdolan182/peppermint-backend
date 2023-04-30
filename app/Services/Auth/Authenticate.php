<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Authenticate service to deal with logins from admins or users
 */
class Authenticate
{
     /**
     * Authdenticate Login with given guard and request
     * @param String $guard
     * @param Request $request
     * @return User
     */
    public static function authLogin($guard, $request)
    {
        if(!Auth::guard($guard)->attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'name' => $user->name,
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }
}