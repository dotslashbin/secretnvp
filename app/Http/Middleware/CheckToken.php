<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use stdClass;

class CheckToken
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

        if($request->token && $request->token === '123') {
            return $next($request);
        }

        $error = new stdClass;
        $error->message = 'No token provided';
        throw new HttpResponseException(response()->json($error, 422));

    }
}
