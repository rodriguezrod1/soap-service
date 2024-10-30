<?php

namespace App\Services\Wallet;

use Illuminate\Support\Facades\Cache;
use App\Services\Client\FindClientByDocumentAndPhoneService;
use App\Services\Wallet\TransactionService;

class ConfirmPaymentService
{

    private $clientFinder;
    private $transactionService;


    public function __construct(FindClientByDocumentAndPhoneService $clientFinder, TransactionService $transactionService)
    {
        $this->clientFinder = $clientFinder;
        $this->transactionService = $transactionService;
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

        $this->transactionService->createWithdrawalTransaction($client->id, $amount);

        return $client;
    }
}
