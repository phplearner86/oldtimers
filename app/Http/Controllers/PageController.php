<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactRequested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.welcome');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(ContactRequest $request)
    {
        $contact = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->body,
        ];

        $recipient = 'g@gmail.com';
        $email = new ContactRequested($contact);

        Mail::to($recipient)->send($email);

        flash()->success('Thank you for your email. I will try to respond as soon as possible.');
        return back();
    }

}
