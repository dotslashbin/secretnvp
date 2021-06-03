<?php

namespace App\Http\Controllers;

use App\Services\NVPServices\NVPReader as NVPReader;
use Illuminate\Http\Request;

class NVPReadAllController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $nvpReader = new NVPReader();
        return $this->executeProcess($nvpReader);
    }
}
