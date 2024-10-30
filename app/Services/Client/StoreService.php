<?php

namespace App\Services\Client;

use App\Models\Client;

class StoreService
{
    public function execute($request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->balance = 0;
        $client->save();
        return $client;
    }
}
