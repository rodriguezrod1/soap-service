<?php

namespace App\Services\Wallet;

use App\Services\Client\FindClientByDocumentAndPhoneService;

class RechargeWalletService
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

        if ($client->balance + $amount > 1000000) {
            throw new \Exception('Excedió el límite máximo de saldo');
        }

        $client->balance += $amount;
        $client->save();

        return  $client;
    }
}
