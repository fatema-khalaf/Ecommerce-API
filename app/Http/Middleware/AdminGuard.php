<?php

namespace App\Http\Middleware;
use Closure;
// This middelware change the provider in api guard to admins THIS NOT IN USE FOR NOW
class AdminGuard
{
public function handle($request, Closure $next)
    {
        config(['auth.guards.api.provider' => 'admins']);
        return $next($request);
    }
}
?>