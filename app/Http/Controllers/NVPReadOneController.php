<?php

namespace App\Http\Controllers;

use App\Services\NVPServices\NVPReader as NVPReader;
use App\Http\Requests\NVPGetRequest;

class NVPReadOneController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(NVPGetRequest $request)
    {
        // Initilaizes the values for key and timestamp
        $key = $request->key;
        $timestamp = ($request->timestamp)? (int)$request->timestamp:'';

        // Creates a NVPReader instance to execute the task
        $nvpReader = new NVPReader($key, $timestamp);
        $nvpReader->SetReturnStructure(config('app.NVPReturnStructures.SINGLE_RECORD'));
        return $this->executeProcess($nvpReader);
    }
}