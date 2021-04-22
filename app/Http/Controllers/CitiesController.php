<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
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

    public function getCitiesData(Request $request){
        $arrayData = [
            'cities' => City::where('id_state', '=', $request->input('id_state'))->get(),
            'message' => 'Get all Cities'
        ];

        return response()->json($arrayData, 200);
    }
}
