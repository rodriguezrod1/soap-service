<?php

namespace App\UseCases\Wallet;

use App\Services\Wallet\RechargeWalletService;

class RechargeWalletUseCase
{
    protected $walletService;

    public function __construct(RechargeWalletService $walletService)
    {
        $this->walletService = $walletService;
    }


    public function execute($request)
    {
        return $this->walletService->execute($request->document, $request->phone, $request->amount);
    }
}
