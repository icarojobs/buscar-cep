<div>
    <x-notifications />
    <form class="p-8 bg-gray-200 flex flex-col w-1/2 mx-auto gap-4">
        <h1>Buscador de CEP!</h1>
        <div class="flex flex-col w-1/2">
            <x-input wire:model.lazy="data.zipcode" label="CEP" placeholder="Informe o seu CEP" />
        </div>
        <div class="flex flex-col w-1/2">
            <x-input wire:model="data.street" label="Rua" placeholder="Informe a Rua" />
        </div>
        <div class="flex flex-col w-1/2">
            <x-input wire:model="data.neighborhood" label="Bairro" placeholder="Informe o Bairro" />
        </div>
        <div class="flex flex-col w-1/2">
            <x-input wire:model="data.city" label="Cidade" placeholder="Informe a Cidade" />
        </div>
        <div class="flex flex-col w-1/2">
            <x-input wire:model="data.state" label="Estado" placeholder="Informe o Estado" />
        </div>
        <div class="flex gap-x-4">
            <x-button wire:click="save" spinner="save" positive label="Salvar Endereço" />
        </div>
    </form>

    <hr>
    <div class="my-8 w-[70%] container mx-auto bg-gray-200 p-4">

        <x-input wire:model="search" label="Buscar Rua" placeholder="Informe o nome da rua..." />

        <table class="table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2">CEP</th>
                <th class="px-4 py-2">Rua</th>
                <th class="px-4 py-2">Bairro</th>
                <th class="px-4 py-2">Cidade</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody>

            @foreach($this->address as $address)
                <tr>
                    <td class="border px-4 py-2">{{ $address->zipcode }}</td>
                    <td class="border px-4 py-2">{{ $address->street }}</td>
                    <td class="border px-4 py-2">{{ $address->neighborhood }}</td>
                    <td class="border px-4 py-2">{{ $address->city }}</td>
                    <td class="border px-4 py-2">{{ $address->state }}</td>
                    <td class="border px-4 py-2 flex gap-x-4">
                        <button class="text-blue-500" wire:click="edit({{ $address->id }})" type="button">Editar</button>
                        <button class="text-red-500" wire:click="remove({{ $address->id }})" type="button">Excluir</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="flex justify-end">
            {!! $this->address->links() !!}
        </div>
    </div>
</div>
