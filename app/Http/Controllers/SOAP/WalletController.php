<?php

namespace App\Http\Controllers\SOAP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Client\StoreUseCases;
use App\UseCases\Wallet\{
    CheckBalanceUseCase,
    MakePaymentUseCase,
    ConfirmPaymentUseCase,
    RechargeWalletUseCase
};
use App\Http\Requests\StoreClientsRequest;
use SoapServer;


class WalletController extends Controller
{
    private $storeUseCases;
    private $checkBalanceUseCase;
    private $makePaymentUseCase;
    private $confirmPaymentUseCase;
    private $rechargeWalletUseCase;

    public function __construct(
        StoreUseCases $storeUseCases,
        CheckBalanceUseCase $checkBalanceUseCase,
        MakePaymentUseCase $makePaymentUseCase,
        ConfirmPaymentUseCase $confirmPaymentUseCase,
        RechargeWalletUseCase $rechargeWalletUseCase
    ) {
        $this->storeUseCases = $storeUseCases;
        $this->checkBalanceUseCase = $checkBalanceUseCase;
        $this->makePaymentUseCase = $makePaymentUseCase;
        $this->confirmPaymentUseCase = $confirmPaymentUseCase;
        $this->rechargeWalletUseCase = $rechargeWalletUseCase;
    }


    public function handleSoapRequest(SoapServer $soapServer)
    {
        $soapServer->handle();
    }

    public function checkBalance(Request $request)
    {
        try {
            $response = $this->checkBalanceUseCase->execute($request);
            return $this->successResponse($response, 'Saldo consultado con exito.');
        } catch (\Exception $e) {
            return $this->errorResponse($e, 500);
        }
    }


    public function registerClient(StoreClientsRequest $request)
    {
        try {
            $response = $this->storeUseCases->execute($request->validated());
            return $this->successResponse($response, 'Cliente resgitrado con exito.');
        } catch (\Exception $e) {
            return $this->errorResponse($e, 500);
        }
    }


    public function ConfirmPayment(Request $request)
    {
        try {
            $response = $this->confirmPaymentUseCase->execute($request);
            return $this->successResponse($response, 'Confirmación realizada con exito.');
        } catch (\Exception $e) {
            return $this->errorResponse($e, 500);
        }
    }



    public function MakePayment(Request $request)
    {
        try {
            $response = $this->makePaymentUseCase->execute($request);
            return $this->successResponse($response, 'Pago realizado con exito.');
        } catch (\Exception $e) {
            return $this->errorResponse($e, 500);
        }
    }



    public function RechargeWallet(Request $request)
    {
        try {
            $response = $this->rechargeWalletUseCase->execute($request);
            return $this->successResponse($response, 'Recarga realizada con exito.');
        } catch (\Exception $e) {
            return $this->errorResponse($e, 500);
        }
    }
}
