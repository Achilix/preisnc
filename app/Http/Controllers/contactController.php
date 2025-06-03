<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        // Handle the form submission (e.g., send an email)
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to('admin@example.com') // Replace with your admin email
                    ->subject($request->subject)
                    ->from($request->email, $request->name);
        });

        return back()->with('success', 'Votre message a été envoyé avec succès ! / تم إرسال رسالتك بنجاح!');
    }
}
