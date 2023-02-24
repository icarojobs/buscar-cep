<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Address;

class AddressStoreAction
{
    public static function save(array $data): void
    {
        Address::updateOrCreate(
            [
                'zipcode' => $data['zipcode'],
            ],
            [
                'street' => $data['street'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $data['state'],
            ]);
    }
}
