<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Auth\Authenticate;
use App\Models\Consumer;
use App\Http\Requests\Consumer\ConsumerLoginRequest;
use App\Http\Resources\Consumer\ConsumerResource;

class ConsumerController extends Controller
{
    //
     //
     public function index()
     {
         
     }

    /**
     * Display the User resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function show() 
    {
        return new ConsumerResource(auth()->user());
    }
 
      /**
      * Login The User
      * @param ConsumerLoginRequest $request
      * @return Consumer
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
