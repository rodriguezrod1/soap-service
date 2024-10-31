<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PaymentTokenMail;
use Illuminate\Support\Facades\Mail;

class SendPaymentTokenEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $clientEmail;
    private $token;

    public function __construct($clientEmail, $token)
    {
        $this->clientEmail = $clientEmail;
        $this->token = $token;
    }

    public function handle()
    {
        Mail::to($this->clientEmail)->send(new PaymentTokenMail($this->token));
    }
}
