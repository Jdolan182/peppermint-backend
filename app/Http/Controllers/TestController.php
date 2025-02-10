<?php

namespace App\Http\Controllers;

use App\Services\Xero\Xero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    //

    public function index(Request $request)
    {

       
        return outputJson('test'); 
    }
}
