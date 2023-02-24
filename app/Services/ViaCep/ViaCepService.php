<?php

declare(strict_types=1);

namespace App\Services\ViaCep;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public static function handle(string $zipcode): array
    {
        $response = Http::get("https://viacep.com.br/ws/{$zipcode}/json/")->json();

        return [
            'zipcode' => $response['cep'],
            'street' => $response['logradouro'],
            'neighborhood' => $response['bairro'],
            'city' => $response['localidade'],
            'state' => $response['uf'],
        ];
    }
}
