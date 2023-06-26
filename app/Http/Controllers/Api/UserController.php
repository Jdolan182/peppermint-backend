<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    //
    public function index()
    {
        
    }

     /**
     * Display the User resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\User\UserResource
     */
    public function show() 
    {
        return new UserResource(auth()->user());
    }
}
