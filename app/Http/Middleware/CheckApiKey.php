<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $headerKey = $request->header('X-API-KEY');
        $queryKey  = $request->query('api_key');

        $apiKey = $headerKey ?? $queryKey;

        if (!$apiKey) {
            return response()->json(['error' => 'API key missing'], 401);
        }

        $key = ApiKey::where('key', $apiKey)->first();

        if (!$key) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        return $next($request);
    }
}
