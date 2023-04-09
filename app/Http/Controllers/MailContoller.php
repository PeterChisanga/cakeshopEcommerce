<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Mail;
use App\Mail\MailNotify;

class MailContoller extends Controller
{
    public function index(Request $req){
        $data = [
            'subject'=> $req->subject,
            'message'=> $req->message,

        ];

        try {
            Mail::to($req->email)->send(new MailNotify($data));
            return response()->json(['Email sent successfully']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            dd($e->getMessage()); // Dump and die to inspect the error message
            return response()->json(['Sorry something went wrong']);
        }
        
    }
}
