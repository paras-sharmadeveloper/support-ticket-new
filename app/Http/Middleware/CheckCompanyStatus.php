<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCompanyStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->company && $user->company->status !== 'active') {
            abort(403, 'Company account inactive');
        }

        return $next($request);
    }
}
