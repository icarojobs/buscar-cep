<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Actions\AddressGetPropertiesAction;
use App\Actions\AddressStoreAction;
use App\Http\Livewire\Traits\AddressPropertiesValidationMessagesTrait;
use App\Http\Livewire\Traits\AddressPropertiesRulesValidationTrait;
use App\Models\Address;
use App\Services\ViaCep\ViaCepService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SearchZipcode extends Component
{
    use Actions;
    use AddressPropertiesRulesValidationTrait;
    use AddressPropertiesValidationMessagesTrait;

    public array $data = [];

    public string $search = '';

    protected $queryString = ['search'];

    public function updated(string $key, string $value): void
    {
        if ($key === 'data.zipcode') {
            $this->data = ViaCepService::handle($value);
        }
    }

    public function save(): void
    {
        $this->validate();

        AddressStoreAction::save($this->data);

        $this->showNotification('Crição/Atualização', 'O endereço foi criado/atualizado com sucesso!');

        $this->resetExcept('addresses');
    }

    public function edit(string $id): void
    {
        $this->data = AddressGetPropertiesAction::handle($id);
    }

    public function remove(string $id): void
    {
        Address::find($id)?->delete();

        $this->showNotification('Exclusão de Endereço', 'Endereço excluído com sucesso!');
    }

    private function showNotification(string $title, string $message): void
    {
        $this->notification()->success($title, $message);
    }

    public function getAddressProperty()
    {
        if ($this->search) {
            return Address::where('street', 'like', "%{$this->search}%")->paginate(2);
        }

        return Address::paginate(2);
    }

    public function mount(): void
    {
        $this->data = AddressGetPropertiesAction::getEmptyProperties();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.search-zipcode');
    }
}
