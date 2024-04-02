<?php

namespace App\Http\Controllers;
use App\Mail\ContactMail;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function ContactPage()
    {
        return view('custom_views.user_views.contact');
    }

    public function sendEmail(Request $request){
       
        $validateData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        if($validateData){
            Mail::to('diproyf87@gmail.com')->send(new ContactMail($validateData));
            return back()->with('message_sent', 'Your message has been sent successfully');
        }
    }
}
