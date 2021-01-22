<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
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
        // dd(\JWTAuth::user()->permission);
        if (\JWTAuth::user()->permission == 0) {
            return response()->json([
                'errors' => 401,
                'data' => null,
                'message' => 'Unauthorized',
            ]);
        }
        return $next($request);
    }
}