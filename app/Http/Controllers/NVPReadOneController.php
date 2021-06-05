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
        $key = $request->key;
        $timestamp = ($request->timestamp)? $request->timestamp:'';

        $nvpReader = new NVPReader($key, $timestamp);
        $nvpReader->SetReturnStructure(config('app.NVPReturnStructures.SINGLE_RECORD'));
        return $this->executeProcess($nvpReader);
    }
}