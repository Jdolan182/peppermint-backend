<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(AdminLoginRequest $request) :JsonResponse
    {
        try {
            return Authenticate::authLogin('admin', $request);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Revoke token access for user
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser() :JsonResponse
    {
        try {
            return Authenticate::revokeAccess('admin');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
