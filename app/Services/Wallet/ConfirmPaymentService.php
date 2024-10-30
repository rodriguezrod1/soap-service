<?php

namespace App\Services\Wallet;

use Illuminate\Support\Facades\Cache;
use App\Services\Client\FindClientByDocumentAndPhoneService;

class ConfirmPaymentService
{

    private $clientFinder;

    public function __construct(FindClientByDocumentAndPhoneService $clientFinder)
    {
        $this->clientFinder = $clientFinder;
    }


    public function execute($sessionId, $token, $document, $phone, $amount)
    {
        $storedToken = Cache::get("payment_token_{$sessionId}");

        if (!$storedToken || $storedToken != $token) {
            throw new \Exception('Token no válido o sesión expirada');
        }

        $client = $this->clientFinder->execute($document, $phone);

        if (!$client) {
            throw new \Exception('Cliente no encoentrado');
        }

        if ($client->balance < $amount) {
            throw new \Exception('Saldo insuficiente');
        }

        $client->balance -= $amount;
        $client->save();

        Cache::forget("payment_token_{$sessionId}");

        return $client;
    }
}
