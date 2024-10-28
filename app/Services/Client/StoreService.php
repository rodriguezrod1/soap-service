<?php

namespace App\Services\Client;

use App\Models\Client;

class StoreService
{
    public function store($request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();
        return $client;
    }
}
