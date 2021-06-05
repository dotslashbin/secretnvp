<?php

namespace App\Http\Controllers;

use App\Http\Requests\NVPWriteRequest;
use App\Services\NVPServices\NVPWriter as NVPWriter;
use App\Jobs\CreateRecord;

class NVPWriteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(NVPWriteRequest $request)
    {
        // $this->dispatch(new CreateRecord());

        $job = ((new CreateRecord())->delay(30));
        $job->dispatch();


        // $nvpWriter = new NVPWriter($request->key, $request->value);
        // $nvpWriter->SetReturnStructure(config('app.NVPReturnStructures.SINGLE_RECORD'));
        // return $this->executeProcess($nvpWriter);
    }
}
