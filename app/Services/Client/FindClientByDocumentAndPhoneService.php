<?php

namespace App\Services\Client;

use App\Models\Client;

class FindClientByDocumentAndPhoneService
{
    public function execute($document, $phone)
    {
        return Client::where('document', $document)->where('phone', $phone)->first();
    }
}
