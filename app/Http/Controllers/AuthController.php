<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\Authenticate;
use App\Http\Requests\Admin\AdminLoginRequest;
 

class AuthController extends Controller
{
    //
    public function index()
    {

        
        $json = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

        return json_encode($json);
    }

     /**
     * Login The User
     * @param AdminLoginRequest $request
     * @return User
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
}
