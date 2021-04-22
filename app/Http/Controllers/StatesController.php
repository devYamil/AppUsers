<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StatesController extends Controller
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

    public function getStatesData(Request $request){
        $arrayData = [
            'states' => State::where('id_country', '=', $request->input('id_country'))->get(),
            'message' => 'Get all States'
        ];

        return response()->json($arrayData, 200);
    }
}
