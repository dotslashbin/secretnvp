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


        $sampleData = new stdClass;

        $sampleData->key = $request->key;

        $test = NVPModel::find('60b59a9478dad54a3b8b3ca6');
        $sampleData->test = $test;
        
        return response()->json($sampleData)->header('Content-Type', 'application/json');
    }
}
