<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
 

class TestController extends Controller
{
    //
    public function index()
    {
        dd('f');
        outputJson('test');
    }

    
}
