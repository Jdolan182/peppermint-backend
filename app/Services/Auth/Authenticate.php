<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Consumer;

/**
 * Authenticate service to deal with logins from admins or users
 */
class Authenticate
{
    const TOKEN_NAME_API = 'token';
 
     /**
     * Authdenticate Login with given guard and request
     * @param String $guard
     * @param Request $request
     * @return User
     */
    public static function authLogin($guard = 'admin', $request)
    {
        if(!Auth::guard($guard)->attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match',
            ], 401);
        }

        if($guard == 'admin'){
            $user = User::where('email', $request->email)->first();
        }
        else if ($guard == 'consumer'){
            $user = Consumer::where('email', $request->email)->first();
        }

        $user->tokens()->where('name', self::TOKEN_NAME_API)->delete();

        return response()->json([
            'status' => true,
            'message' => 'User Logged in Successfully',
            'name' => $user->name,
            'token' => $user->createToken(self::TOKEN_NAME_API)->plainTextToken
        ], 200);
    }

    public static function revokeAccess($guard = 'admin')
    {

        try {
            auth()->guard($guard)->user()->tokens()->where('name', self::TOKEN_NAME_API)->delete();

        
            return response()->json([
                'status' => true,
                'message' => 'User Logged out Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}