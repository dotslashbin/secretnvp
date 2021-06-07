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

        // Initialized deafult values for page and limit
        $page = ($request->page === NULL || $request->page < 0)? config('app.DEFAULT_SKIP') + 1: (int) $request->page;
        $limit = ($request->limit === NULL || $request->limit < 0)? config('app.DEFAULT_ITEMS_PER_PAGE'): (int) $request->limit;

        // Creates a NVPReader instance to execute the task
        $nvpReader = new NVPReader('', '', $page, $limit);
        $nvpReader->SetReturnStructure(config('app.NVPReturnStructures.DATA_SET'));
        return $this->executeProcess($nvpReader);
    }
}
