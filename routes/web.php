<?php

use Illuminate\Support\Facades\Route;



Route::post('/soap', [App\Http\Controllers\SOAP\WalletController::class, 'handleSoapRequest']);
