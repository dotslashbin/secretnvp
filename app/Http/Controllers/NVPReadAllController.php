<?php

namespace App\Http\Controllers;

use App\Services\NVPServices\NVPReader as NVPReader;
use App\Http\Requests\NVPGetAllRequest;

class NVPReadAllController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(NVPGetAllRequest $request)
    {
        $nvpReader = new NVPReader('', '', $request->page, $request->limit);
        $nvpReader->SetReturnStructure(config('app.NVPReturnStructures.DATA_SET'));
        return $this->executeProcess($nvpReader);
    }
}
