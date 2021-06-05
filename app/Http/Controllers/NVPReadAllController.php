<?php

namespace App\Http\Controllers;

use App\Services\NVPServices\NVPReader as NVPReader;
class NVPReadAllController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $nvpReader = new NVPReader();
        $nvpReader->SetReturnStructure(config('app.NVPReturnStructures.DATA_SET'));
        return $this->executeProcess($nvpReader);
    }
}
