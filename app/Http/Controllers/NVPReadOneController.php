<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NVPServices\NVPReader as NVPReader;
use Illuminate\Support\Facades\Validator;
use stdClass;

class NVPReadOneController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'timestamp' => 'numeric'
        ]);

        if ($validator->fails()) {
            $failure = new stdClass;
            $failure->error = "Unacceptable input format.";
            return GenerateResponse($failure);
        }

        $key = $request->key;
        $timestamp = ($request->timestamp)? $request->timestamp:'';

        $nvpReader = new NVPReader($key, $timestamp);
        $nvpReader->SetReturnStructure(config('app.NVPReturnStructures.SINGLE_RECORD'));
        return $this->executeProcess($nvpReader);
    }
}