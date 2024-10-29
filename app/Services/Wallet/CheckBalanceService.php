<?php

namespace App\Services\Wallet;

use App\Mail\PaymentTokenMail;
use App\Services\Client\FindClientByDocumentAndPhoneService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class CheckBalanceService
{
    private $clientFinder;

    public function __construct(FindClientByDocumentAndPhoneService $clientFinder)
    {
        $this->clientFinder = $clientFinder;
    }

    public function execute($document, $phone, $amount)
    {
        $client = $this->clientFinder->findClientByDocumentAndPhone($document, $phone);

        if (!$client) {
            throw new \Exception('Cliente no encontrado');
        }

        if ($client->wallet->balance < $amount) {
            throw new \Exception('Saldo insuficiente');
        }

        $token = rand(100000, 999999); // Generar un token de 6 dígitos
        $sessionId = uniqid(); // Generar un ID de sesión único

        // Enviar el correo electrónico con el token
        Mail::to($client->email)->send(new PaymentTokenMail($token));

        // Guardar el token y el sessionId en caché
        Cache::put("payment_token_{$sessionId}", $token, now()->addMinutes(10));

        return ['session_id' => $sessionId];
    }
}
