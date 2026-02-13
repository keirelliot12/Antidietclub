<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DisableCsrf
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('DisableCsrf middleware hit', ['path' => $request->path()]);
        return $next($request);
    }
}