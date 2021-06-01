<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

use App\Models\NVPModel;

class NVPReadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $test = NVPModel::where('key', $request->key)->take(1)->get();
        
        return response()->json($test)->header('Content-Type', 'application/json');
    }
}
