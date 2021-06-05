<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NVPServices\NVPWriter as NVPWriter;
use Illuminate\Support\Facades\Validator;
use stdClass;


class NVPWriteController extends Controller
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
            'key' => 'alpha', 
        ]);

        if($validator->fails()) {
            $failure = new stdClass;
            $failure->error = "Unacceptable key format.";
            return GenerateResponse($failure);
        }

        $nvpWriter = new NVPWriter($request->key, $request->value);
        $nvpWriter->SetReturnStructure(config('app.NVPReturnStructures.SINGLE_RECORD'));
        return $this->executeProcess($nvpWriter);
    }
}
