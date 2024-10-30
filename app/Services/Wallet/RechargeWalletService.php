<?php

namespace App\Services\Wallet;

use App\Services\Client\FindClientByDocumentAndPhoneService;
use App\Services\Wallet\TransactionService;

class RechargeWalletService
{

    private $clientFinder;
    private $transactionService;


    public function __construct(FindClientByDocumentAndPhoneService $clientFinder, TransactionService $transactionService)
    {
        $this->clientFinder = $clientFinder;
        $this->transactionService = $transactionService;
    }


    public function execute($document, $phone, $amount)
    {
        $client = $this->clientFinder->execute($document, $phone);

        if (!$client) {
            throw new \Exception('Cliente no encontrado');
        }

        if ($client->balance + $amount > 1000000) {
            throw new \Exception('Excedió el límite máximo de saldo');
        }

        $client->balance += $amount;
        $client->save();

        $this->transactionService->createDepositTransaction($client->id, $amount);

        return  $client;
    }
}
