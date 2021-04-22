<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // NO PONER MIDDLEWARE AUTH $this->middleware('auth');
    }

    public function getCountriesData(Request $request){

        $arrayData = [
            'countries' => Country::all(),
            'message' => 'Get all Countries'
        ];

        return response()->json($arrayData, 200);
    }
}
