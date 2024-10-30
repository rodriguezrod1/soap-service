<?php

namespace App\Services\Wallet;


use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function createDepositTransaction(int $clientId, float $amount): Transaction
    {
        DB::beginTransaction();

        try {
            $transaction = new Transaction();
            $transaction->client_id = $clientId;
            $transaction->amount = $amount;
            $transaction->type = Transaction::TYPE_DEPOSIT;
            $transaction->status = Transaction::STATUS_CONFIRMED;

            $transaction->save();

            DB::commit();

            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createWithdrawalTransaction(int $clientId, float $amount): Transaction
    {
        DB::beginTransaction();

        try {
            $transaction = new Transaction();
            $transaction->client_id = $clientId;
            $transaction->amount = $amount;
            $transaction->type = Transaction::TYPE_WITHDRAWAL;
            $transaction->status = Transaction::STATUS_PENDING;

            $transaction->save();

            DB::commit();

            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
