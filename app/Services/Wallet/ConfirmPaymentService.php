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
            throw new \Exception('Invalid token or session expired');
        }

        $client = $this->clientFinder->execute($document, $phone);

        if (!$client) {
            throw new \Exception('Client not found');
        }

        $wallet = $client->wallet;
        if ($wallet->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }

        $wallet->balance -= $amount;
        $wallet->save();

        // Eliminar el token de la caché después de su uso
        Cache::forget("payment_token_{$sessionId}");

        return $wallet;
    }
}
