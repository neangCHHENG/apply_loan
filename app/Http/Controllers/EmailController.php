<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail()
    {
        // Mail::to('mail@controller.com')->send(new SendMailable());

        $emailJob = (new SendEmailJob())->delay(Carbon::now()->addSeconds(3));
        dispatch($emailJob);

        echo 'email sent';
    }
}
