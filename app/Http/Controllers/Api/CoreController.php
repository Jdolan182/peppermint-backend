<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\User;
use App\Http\Controllers\Controller;

class CoreController extends Controller
{
     /**
     * Return stats for dashboard
     *
     * @return String
     */
    public function stats()
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
