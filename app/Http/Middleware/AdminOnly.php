<?php

namespace App\Http\Middleware;

use Closure;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(!auth()->user()) return $this->back();
        if(auth()->user()->role < 8) return $this->back();
        if(auth()->user()->role == 8 && $request->getMethod() != 'GET') return $this->back();
        return $next($request);
    }

	public function back()
	{
		return redirect()->back()->withWarning('You are currently in view only mode');
	}
}
