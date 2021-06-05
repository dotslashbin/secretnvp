<?php

namespace App\Http\Controllers;

use App\Http\Requests\NVPRequest;
use App\Services\NVPServices\NVPWriter as NVPWriter;

class NVPWriteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(NVPRequest $request)
    {
        $nvpWriter = new NVPWriter($request->key, $request->value);
        $nvpWriter->SetReturnStructure(config('app.NVPReturnStructures.SINGLE_RECORD'));
        return $this->executeProcess($nvpWriter);
    }
}
