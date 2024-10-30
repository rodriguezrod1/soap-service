<?php

namespace App\Services\Wallet;

use App\Services\Client\FindClientByDocumentAndPhoneService;


class CheckBalanceService
{
    private $clientFinder;

    public function __construct(FindClientByDocumentAndPhoneService $clientFinder)
    {
        $this->clientFinder = $clientFinder;
    }

    public function execute($document, $phone)
    {
        $client = $this->clientFinder->execute($document, $phone);

        if (!$client) {
            throw new \Exception('Cliente no encontrado');
        }

        return $client->balance;
    }
}
