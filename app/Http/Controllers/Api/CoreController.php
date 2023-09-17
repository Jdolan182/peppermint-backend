<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Consumer;
use App\Models\User;
use App\Http\Controllers\Controller;

class CoreController extends Controller
{
     /**
     * Return stats for dashboard
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats() :JsonResponse
    {

        $data = [
            'consumers' => Consumer::all()->count(),
            'users' => User::all()->count() 
        ];

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
