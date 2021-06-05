<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\NVPServices\DataServiceINT;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Executes the final process after all the checks have been
     * executed
     *
     * @param DataServiceINT $service
     * @return void
     */
    protected function executeProcess(DataServiceINT $service) {
        $data = $service->RunQuery();
        return GenerateResponse(
            FormatReturn(
                $data, 
                $service->GetReturnStructure(), 
                (property_exists($service, 'page'))? $service->page:null, 
                (property_exists($service, 'limit'))? $service->limit: null
            )
        );
    }
}
