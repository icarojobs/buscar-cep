<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Address;

class AddressGetPropertiesAction
{
    public static function handle(string|int $id): array
    {
        $address = Address::find($id)->toArray();

        return [
            'zipcode' => $address['zipcode'],
            'street' => $address['street'],
            'neighborhood' => $address['neighborhood'],
            'city' => $address['city'],
            'state' => $address['state'],
        ];
    }

    public static function getEmptyProperties(): array
    {
        return [
            'zipcode' => '',
            'street' => '',
            'neighborhood' => '',
            'city' => '',
            'state' => '',
        ];
    }
}
