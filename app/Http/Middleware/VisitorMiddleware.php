<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $isOneDayViews = Visitor::where('ip_address', $request->ip())->get()->contains('visited_at', date("Y-m-d"));

        if (!$isOneDayViews) {
            Visitor::create([
            'ip_address' => $request->ip(),
            'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
