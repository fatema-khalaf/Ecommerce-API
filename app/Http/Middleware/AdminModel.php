<?php

namespace App\Http\Middleware;
use Closure;
// This middelware change the provider in api guard to admins THIS NOT IN USE FOR NOW
class AdminModel
{
public function handle($request, Closure $next)
    {
        // Change user provider model in config file
        config(['auth.providers.users.model' => 'App\Models\Admin']); // use 'App\Models\Admin' NOT App\Models\Admin::class cause this return this file namespace and App\Models\Admin
        
        $request->merge(['scope_name' => 'admin']); // add scope to login admin
        return $next($request);
    }
}
?>