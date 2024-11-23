<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('CRUISE_AUTH_KEY');

        if ($apiKey !== env('CRUISE_AUTH_KEY', '29B37-89DFC5E37A525891-FE788E23')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
