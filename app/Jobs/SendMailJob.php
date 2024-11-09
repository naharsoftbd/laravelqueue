<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMailSuccess;
use App\Mail\UserReportEmail;

class SendMailJob implements ShouldQueue
{
    use Queueable;

    public $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       Mail::to($this->request->email)->send(new RegistrationMailSuccess($this->request));
        Mail::to('naharsoftbd@gmail.com')->send(new UserReportEmail());
    }
}
