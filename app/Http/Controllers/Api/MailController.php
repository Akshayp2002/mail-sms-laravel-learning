<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function index()
    {

        $send = Mail::send('mail.demo', [], function ($message) {

                $message->to('akshay8593995890@gmail.com', 'Akshay');




        });
    }
}
