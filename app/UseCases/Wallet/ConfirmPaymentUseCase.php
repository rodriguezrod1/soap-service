<?php

namespace App\UseCases\Wallet;

use App\Services\Wallet\ConfirmPaymentService;

class ConfirmPaymentUseCase
{
    protected $walletService;

    public function __construct(ConfirmPaymentService $walletService)
    {
        $this->walletService = $walletService;
    }


    public function execute($request)
    {
        return $this->walletService->execute($request->sessionId, $request->token, $request->document, $request->phone, $request->amount);
    }
}
