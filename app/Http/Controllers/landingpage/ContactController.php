<?php

namespace App\Http\Controllers\landingpage;

use App\Mail\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendmessage(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required',
            'subject'     => 'nullable',
            'email'     => 'required|email:dns',
            'message'  => 'required',
        ]);
        Mail::to('fajriansyahdeckys@gmail.com')->send(new Contact($data));
        return redirect('/#contact')->with('msg', '<div class="alert alert-success" role="alert">Terimakasih, Pesan Anda telah berhasil terkirim!</div>');
    }
}