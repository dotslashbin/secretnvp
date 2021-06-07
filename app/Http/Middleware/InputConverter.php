<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class InputConverter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $expectedJSON = $request->all();
        if(!is_array($expectedJSON) || count($expectedJSON) > 1) {
            // TODO: implement helper return   
            return new JsonResponse('Invalid input format', 422);
        }

        foreach($expectedJSON as $inputtedKey => $inputtedValue) {
            $request->merge([ "key" => (string) $inputtedKey, "value" => (string)$inputtedValue]);
        }

        return $next($request);
    }
}