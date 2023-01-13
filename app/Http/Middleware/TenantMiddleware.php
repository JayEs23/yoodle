<?php

namespace App\Http\Middleware;

use App\Models\Library;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $subdomain = explode('.', $request->getHost())[0];
        $library = Library::where('subdomain', $subdomain)->first();

        if($library){
            $request->attributes->add(['library_id' => $library->id]);
            return $next($request);
        }

        return response()->json(['error' => 'Invalid subdomain'], 401);
    }

}
