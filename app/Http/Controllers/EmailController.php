<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\{EmailSetting, EmailAttachment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    //
    public function inbox()
    {

        $emails = Email::where('user_id', auth()->id())
            ->where('type', 'inbox')
            ->latest()
            ->get();

        return view('mail.inbox', compact('emails'));
    }
    public function sent()
    {

        $emails = Email::where('user_id', auth()->id())
            ->where('type', 'sent')
            ->latest()
            ->get();

        return view('mail.sent', compact('emails'));
    }
    public function compose()
    {
        return view('mail.compose');
    }


    public function  send(Request $request)
    {
        $user = auth()->user();
        if ($user->role === 'super_admin') {
            $companyId = 0; // Super Admin emails can have company_id = 0 or null
        } else {
            $companyId = $user->company_id;
        }
        $setting = EmailSetting::where('company_id', $companyId)->first();
        //dd($setting);
        Mail::raw($request->message, function ($mail) use ($request, $setting) {

            $mail->from($setting->from_address, $setting->from_name);

            $mail->to($request->to)
                ->subject($request->subject);
        });

        Email::create([

            'company_id' => $user->company_id ?? 0,
            'user_id' => $user->id,
            'from_email' => $user->email,
            'to_email' => $request->to,
            'subject' => $request->subject,
            'body' => $request->message,
            'type' => 'sent'

        ]);

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $name = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/emails'), $name);

                EmailAttachment::create([

                    'email_id' => $email->id,
                    'file' => $name

                ]);
            }
        }

        return redirect()->route('mail.sent')
            ->with('success', 'Email sent');
    }
}
