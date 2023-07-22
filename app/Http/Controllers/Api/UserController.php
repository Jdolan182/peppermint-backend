<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Http\Requests\Search\IndexRequest;


class UserController extends Controller
{
 /**
     * List users
     *
     * @param  IndexRequest $IndexRequest
     * @return App\Http\Resources\User\UserResource
     */
    public function index(IndexRequest $request)
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
     * @return String
     */
    public function create(UserCreateRequest $request): String
    {

        try{
            $user = user::create([
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

            $user->update($request->validated());

            DB::commit();

            return new UserResource($user->refresh());
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
