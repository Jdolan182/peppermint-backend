<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {

        
        $json = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

        return json_encode($json);
    }

    public function post(Request $request)
    {

        $json = $request->input('data');

        return json_encode($json);
       //
    }
}
