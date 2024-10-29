<?php

namespace App\Services\Client;

use App\Models\{Client, Wallet};

class StoreService
{
    public function store($request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();
        Wallet::create(['client_id' => $client->id, 'balance' => 0]);
        return $client;
    }
}
