<?php

namespace App\Http\Controllers\Api;

use App\Models\Consumer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Auth\Authenticate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Consumer\ConsumerResource;
use App\Http\Requests\Consumer\ConsumerLoginRequest;
use App\Http\Requests\Consumer\ConsumerSignupRequest;
use App\Http\Requests\Consumer\ConsumerEditRequest;
use App\Http\Requests\Consumer\ConsumerEditPasswordRequest;
use App\Http\Requests\Consumer\ConsumerEditDetailsRequest;
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
    public function index(IndexRequest $request) :AnonymousResourceCollection
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
     * @param  Consumer $consumer
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function show(Consumer $consumer) :ConsumerResource
    {
        return new ConsumerResource($consumer);
    }

    /**
     * Display the logged in Consumer resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function auth() :ConsumerResource
    {
        return new ConsumerResource(auth()->guard('consumer')->user());
    }

    /**
     * Edit Consumer.
     *
     * @param ConsumerEditRequest $request
     * @param Consumer $consumer
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function edit(ConsumerEditRequest $request, Consumer $consumer)
    {
        DB::beginTransaction();

        try {


            if($request->input('password')){
                $consumer->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);
            }
            else {
                $consumer->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);
            }
            DB::commit();

            return new ConsumerResource($consumer->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Update Consumer Details.
     *
     * @param ConsumerEditDetailsRequest $request
     * @param Consumer $consumer
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function updateDetails(ConsumerEditDetailsRequest $request, Consumer $consumer)
    {
        DB::beginTransaction();

        try {

            $consumer->update([
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ]);

            DB::commit();

            return new ConsumerResource($consumer->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Update Consumer Password.
     *
     * @param ConsumerEditPasswordRequest $request
     * @param Consumer $consumer
     * @return App\Http\Resources\Consumer\ConsumerResource
     */
    public function updatePassword(ConsumerEditPasswordRequest $request, Consumer $consumer)
    {
        DB::beginTransaction();

        try {

            $consumer->update([
                'password' => Hash::make($request->input('password')),
            ]);


            DB::commit();

            return new ConsumerResource($consumer->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
 
    /**
     * Login The Consumer
     * 
     * @param ConsumerLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(ConsumerLoginRequest $request)
    {
        try {
            return Authenticate::authLogin('consumer', $request);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Sign up The Consumer
     * 
     * @param ConsumerSignupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signupUser(ConsumerSignupRequest $request) :JsonResponse
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
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Delete Consumer.
     * 
     * @param Consumer $consumer
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Consumer $consumer) :JsonResponse
    {
        DB::beginTransaction();

        try{
         
            $consumer->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Consumer Deleted'
            ], 200);
        }
        catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Revoke token access for Consumer
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser() :JsonResponse
    {
        try {
            return Authenticate::revokeAccess('consumer');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
