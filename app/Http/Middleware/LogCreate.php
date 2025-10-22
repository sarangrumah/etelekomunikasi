<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $logChange)
    {
        // You can pass any data to the request
        $variable = 'Your custom variable';
        $request->attributes->set('customVariable', $variable);

        return $next($request);
    }
}