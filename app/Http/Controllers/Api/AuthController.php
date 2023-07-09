<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\Authenticate;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Controllers\Controller;
 

class AuthController extends Controller
{
    //
    public function index()
    {
        
    }

    /**
     * Login The User
     * @param AdminLoginRequest $request
     * @return Array
     */
    public function loginUser(AdminLoginRequest $request)
    {
        try {
            return Authenticate::authLogin('admin', $request);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Revoke token access for user
     * @return Array
     */
    public function logoutUser()
    {
        try {
            return Authenticate::revokeAccess('admin');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
