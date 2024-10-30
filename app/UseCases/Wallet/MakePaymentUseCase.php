<?php

namespace App\UseCases\Wallet;

use App\Services\Wallet\MakePaymentService;

class MakePaymentUseCase
{
    protected $walletService;

    public function __construct(MakePaymentService $walletService)
    {
        $this->walletService = $walletService;
    }


    public function execute($request)
    {
        return $this->walletService->execute($request->document, $request->phone, $request->amount);
    }
}
