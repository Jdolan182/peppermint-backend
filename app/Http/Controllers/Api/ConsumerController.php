<?php

namespace App\Http\Controllers\Api;

use App\Models\Consumer;
use Illuminate\Http\Request;
use App\Services\Auth\Authenticate;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Consumer\ConsumerResource;
use App\Http\Requests\Consumer\ConsumerLoginRequest;
use App\Http\Requests\Consumer\ConsumerSignupRequest;

class ConsumerController extends Controller
{
    /**
     * List consumers
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
     public function index(Request $request)
     {
        return ConsumerResource::collection(Consumer::paginate(1));
     }

    /**
     * Display the Consumer resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function show() 
    {
        return new ConsumerResource(auth()->user());
    }
 
    /**
     * Login The Consumer
     * @param ConsumerLoginRequest $request
     * @return Array
     */
    public function loginUser(ConsumerLoginRequest $request)
    {
        try {
            return Authenticate::authLogin('consumer', $request);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Sign up The Consumer
     * @param ConsumerSignupRequest $request
     * @return Array
     */
    public function signupUser(ConsumerSignupRequest $request)
    {

        try{
            $consumer = Consumer::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created'
            ], 200);
        }
        catch(Exception $e){
            if($e){
                
            }
        }
    }

    /**
     * Revoke token access for Consumer
     * @return Array
     */
    public function logoutUser()
    {
        try {
            return Authenticate::revokeAccess('consumer');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
