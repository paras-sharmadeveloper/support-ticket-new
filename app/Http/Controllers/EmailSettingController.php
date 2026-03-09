<?php

namespace App\Http\Controllers;

use App\Models\EmailSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailSettingController extends Controller
{

    public function index()
    {
        $companyId = auth()->user()->company_id ?? 0;

        $setting = EmailSetting::where('company_id', $companyId)->first();

        return view('email.settings', compact('setting'));
    }

    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id ?? 0;
        EmailSetting::updateOrCreate(

            ['company_id' => $companyId],

            [
                'host' => $request->host,
                'port' => $request->port,
                'username' => $request->username,
                'password' => $request->password,
                'encryption' => $request->encryption,
                'from_address' => $request->from_address,
                'from_name' => $request->from_name,
                'imap_host' => $request->imap_host,
                'imap_port' => $request->imap_port,
                'imap_username' => $request->imap_username,
                'imap_password' => $request->imap_password
            ]

        );

        return back()->with('success', 'Email settings saved');
    }

    public function sendTest(Request $request)
    {
        try {
// dd(config('mail.mailers.smtp'));
            Mail::raw('This is a test email from support system', function ($mail) use ($request) {

                $mail->to($request->email)
                    ->subject('Test Email');

            });

            return back()->with('success','Test email sent successfully');

        } catch (\Exception $e) {

            return back()->with('error',$e->getMessage());

        }
    }
}
