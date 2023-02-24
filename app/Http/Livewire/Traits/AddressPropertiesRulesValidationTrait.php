<?php

declare(strict_types=1);

namespace App\Http\Livewire\Traits;

trait AddressPropertiesRulesValidationTrait
{
    protected array $rules = [
        'data.zipcode' => ['required'],
        'data.street' => ['required'],
        'data.neighborhood' => ['required'],
        'data.city' => ['required'],
        'data.state' => ['required', 'max:2'],
    ];
}
