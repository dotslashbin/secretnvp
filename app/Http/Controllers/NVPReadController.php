<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NVPServices\NVPReader as NVPReader;
use Illuminate\Support\Facades\Validator;
use stdClass;

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
        $validator = Validator::make($request->all(), [
            'timestamp' => 'numeric'
        ]);

        if ($validator->fails()) {
            $failure = new stdClass;
            $failure->error = $validator->;
            return GenerateResponse($failure);
        }

        $key = $request->key;
        $timeStamp = ($request->timeStamp)? $request->timeStamp:'';

        $nvpReader = new NVPReader($key, $timeStamp);
        return $this->executeProcess($nvpReader);
    }
}