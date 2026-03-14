<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Models\EmailSetting;

class MailService
{

    public static function send($to, $subject, $view, $data = [], $companyId = null)
    {

        $setting = EmailSetting::where('company_id', $companyId)->first();

        if (!$setting) {
            $setting = EmailSetting::where('company_id', 0)->first(); // super admin
        }

        if ($setting) {

            Config::set('mail.mailers.smtp.host', $setting->host);
            Config::set('mail.mailers.smtp.port', $setting->port);
            Config::set('mail.mailers.smtp.username', $setting->username);
            Config::set('mail.mailers.smtp.password', $setting->password);
            Config::set('mail.mailers.smtp.encryption', $setting->encryption);

            Config::set('mail.from.address', $setting->from_address);
            Config::set('mail.from.name', $setting->from_name);
        }

        Mail::send($view, $data, function ($mail) use ($to, $subject) {

            $mail->to($to)
                ->subject($subject);
        });
    }
}
