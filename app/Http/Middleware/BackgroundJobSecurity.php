<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BackgroundJobSecurity
{
    public function handle(Request $request, Closure $next)
    {
        $allowedClasses = config('background_jobs.allowed_classes', []);
        $class = $request->route('class');

        if (!in_array($class, $allowedClasses)) {
            abort(403, 'Unauthorized background job class');
        }

        return $next($request);
    }
}