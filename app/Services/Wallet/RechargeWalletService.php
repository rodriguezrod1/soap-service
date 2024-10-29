<?php

namespace App\Services\Wallet;

use App\Models\Wallet;

class RechargeWalletService
{

    public function rechargeWallet($client, $amount)
    {
        $currentBalance = $client->wallet->balance ?? 0;

        if ($currentBalance + $amount > 1000000) {
            throw new \Exception('Excedió el límite máximo de saldo');
        }

        $newBalance = $currentBalance + $amount;

        $client->wallet()->update(['balance' => $newBalance]);

        return  $newBalance;
    }
}
