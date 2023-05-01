<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        $email = $request->email;
        $name  = $request->name;
        $text  = $request->message;

        Mail::to('ulvi96alili@gmail.com')->send(new SendMail($email, $name, $text));

        alert()->success("Successful", "Mail send successfully")->persistent(true, true);

        return redirect()->back();
    }
}
