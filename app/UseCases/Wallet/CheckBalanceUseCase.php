<?php

namespace App\UseCases\Wallet;

use App\Services\Wallet\CheckBalanceService;

class CheckBalanceUseCase
{
    protected $walletService;

    public function __construct(CheckBalanceService $walletService)
    {
        $this->walletService = $walletService;
    }


    public function execute($request)
    {
        return $this->walletService->execute($request->document, $request->phone);
    }
}
