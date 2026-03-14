<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class CheckCompanyStatus
{
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // Super Admin bypass
        if ($user->role === 'super_admin') {
            return $next($request);
        }

        // Get company
        $company = Company::find($user->company_id);

        // Company not found
        if (!$company) {

            Auth::logout();

            return redirect('/login')
                ->with('error', 'Company account not found.');
        }

        // Company inactive
        if ($company->status !== 'active') {

            Auth::logout();

            return redirect('/login')
                ->with('error', 'Your company account is inactive. Contact administrator.');
        }

        return $next($request);
    }
}
