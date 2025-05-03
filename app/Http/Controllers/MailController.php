<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $email = $request->input('email');
        $messageContent = $request->input('message');

        // Отправляем письмо
        Mail::to('your-email@example.com')->send(new ContactMail($email, $messageContent));

        return back()->with('success', 'Email has been sent!');
    }
}
