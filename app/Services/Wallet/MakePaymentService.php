<?php

namespace App\Services\Wallet;

use App\Services\Client\FindClientByDocumentAndPhoneService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\PaymentTokenMail;


class MakePaymentService
{
    private $clientFinder;

    public function __construct(FindClientByDocumentAndPhoneService $clientFinder)
    {
        $this->clientFinder = $clientFinder;
    }


    public function execute($document, $phone, $amount)
    {
        $client = $this->clientFinder->execute($document, $phone);

        if (!$client) {
            throw new \Exception('Cliente no encontrado');
        }

        if ($client->balance < $amount) {
            throw new \Exception('Saldo insuficiente');
        }

        $token = rand(100000, 999999);
        $sessionId = uniqid();

        Mail::to($client->email)->send(new PaymentTokenMail($token));

        Cache::put("payment_token_{$sessionId}", $token, now()->addMinutes(10));

        return ['session_id' => $sessionId];
    }
}
