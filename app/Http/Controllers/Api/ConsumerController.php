<?php

namespace App\Http\Controllers\Api;

use App\Models\Consumer;
use Illuminate\Http\Request;
use App\Services\Auth\Authenticate;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Consumer\ConsumerResource;
use App\Http\Requests\Consumer\ConsumerLoginRequest;
use App\Http\Requests\Consumer\ConsumerSignupRequest;
use App\Http\Requests\Search\IndexRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConsumerController extends Controller
{
    /**
     * List consumers
     *
     * @param  IndexRequest $IndexRequest
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function index(IndexRequest $request)
    {
        $search = $request->safe()->keyword ?? false;
        $limit = $request->limit ?? 30;

        $query = Consumer::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        return ConsumerResource::collection($query->paginate($limit)->withQueryString());
    }

    /**
     * Display the Consumer resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function show() :ConsumerResource
    {
        return new ConsumerResource(auth()->user());
    }
 
    /**
     * Login The Consumer
     * @param ConsumerLoginRequest $request
     * @return String
     */
    public function loginUser(ConsumerLoginRequest $request): String 
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
     * @return String
     */
    public function signupUser(ConsumerSignupRequest $request): String
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
     * @return String
     */
    public function logoutUser(): String
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
