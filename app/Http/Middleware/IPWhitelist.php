<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IPWhitelist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $whitelist = [
        '127.0.0.1',
    ];
    public function handle(Request $request, Closure $next): Response
    {
        // In địa chỉ IP của request để kiểm tra
        $ip = $request->ip();
        error_log("Request IP: " . $ip);

        if (empty($this->whitelist)) {
            abort(403);
        }

        if (!in_array($ip, $this->whitelist)) {
            abort(403);
    }
        return $next($request);
    }
}
