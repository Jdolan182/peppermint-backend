<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Search\IndexRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Http\Requests\User\UserCreateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
 /**
     * List users
     *
     * @param  IndexRequest $IndexRequest
     * @return App\Http\Resources\User\UserResource
     */
    public function index(IndexRequest $request) :AnonymousResourceCollection
    {
        $search = $request->safe()->keyword ?? false;
        $limit = $request->limit ?? 30;

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        return UserResource::collection($query->paginate($limit)->withQueryString());
    }

    /**
     * Display the User resource.
     *
     * @param  User $user
     * @return App\Http\Resources\User\UserResource
     */
    public function show(User $user) :UserResource
    {
        return new UserResource($user);
    }

     /**
     *  Display the logged in User resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\User\UserResource
     */
    public function auth() 
    {
        return new UserResource(auth()->user());
    }

    /**
     * Create user
     * 
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(UserCreateRequest $request) :JsonResponse
    {

        try{
            $user = user::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created',
                'user' => new UserResource($user)
            ], 201);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Delete User.
     * 
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user) :JsonResponse
    {
        DB::beginTransaction();

        try{
         
            $user->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User Deleted'
            ], 200);
        }
        catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Edit User.
     *
     * @param UserEditRequest $request
     * @param User $user
     * @return App\Http\Resources\user\UserResource
     */
    public function edit(UserEditRequest $request, User $user) :UserResource
    {
        DB::beginTransaction();

        try {
                
            if($request->input('password')){
                $user->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);
            }
            else {
                $user->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);
            }
            DB::commit();

            return new UserResource($user->refresh());
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
