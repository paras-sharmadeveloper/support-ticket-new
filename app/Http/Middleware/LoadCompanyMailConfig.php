<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\EmailSetting;

class LoadCompanyMailConfig
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) { 
            $companyId = auth()->user()->company_id ?? 0;

            $setting = EmailSetting::where('company_id', $companyId)->first();

            if ($setting) {

                Config::set('mail.default', 'smtp');

                Config::set('mail.mailers.smtp.host', $setting->host);
                Config::set('mail.mailers.smtp.port', $setting->port);
                Config::set('mail.mailers.smtp.username', $setting->username);
                Config::set('mail.mailers.smtp.password', $setting->password);
                Config::set('mail.mailers.smtp.encryption', $setting->encryption);

                Config::set('mail.from.address', $setting->from_address);
                Config::set('mail.from.name', $setting->from_name);
            }
        }

        return $next($request);
    }
}
