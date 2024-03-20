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

       // if($request->exists('access_token')){
            dd($request);
        //}
        $xeroService = new Xero();
        $accessToken = $xeroService->auth();


        //dd($accessToken);
        if ($accessToken) {

        
            $xeroService->syncInvoices();

            // Use the access token to make authenticated requests to the Xero API
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken])
                ->get('https://api.xero.com/your-api-endpoint');

            // Process the API response as needed
            $data = $response->json();
            // Handle the API response data
        } else {
            // Handle the case where you couldn't obtain an access token
            // This could be due to invalid credentials or other issues
        }
    }
}
