<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        var_dump($request);
        exit('you are writing');
    }
}
