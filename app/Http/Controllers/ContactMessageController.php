<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(Request $request){
        $this->validate($request, [
                'name' => 'required|string',
                'email' => ['required', 'email'],
                'message' => 'required'
            ]);

        Mail::send('emails.contact-message', ['msg' => $request->message], function ($mail) use($request){
            $mail->from($request->email, $request->name);

            $mail->to('frankstekelenburg@ziggo.nl')->subject('contact bericht');
        });

        return redirect()->back()->with('flash_message', 'bedankt voor je bericht!');
    }
}
