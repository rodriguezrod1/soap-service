<?php

namespace App\Services\Wallet;

use App\Models\Wallet;

class DeductBalance
{
    public function deductBalance(Wallet $wallet, $amount)
    {
        if ($wallet->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }
        $wallet->balance -= $amount;
        $wallet->save();
        return $wallet;
    }
}
