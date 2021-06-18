<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use stdClass;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckJSON
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
        $body = $request->getConent();

        if(!json_decode($body) || json_decode($body) == false) {
            $error = new stdClass;
            $error->message = 'Invalid JSON format';
            throw new HttpResponseException(response()->json($error, 422));
        }

        return $next($request);
    }
}
