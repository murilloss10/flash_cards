<x-app-layout>
    <x-slot name="header" style="background-color: {{ $list->color }} !important">
        
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($list->name) }}
            </h2>
            
            <a href="{{ route('cards.criar', $list) }}" class="btn btn-outline-dark">Adicionar Card</a>
        </div>
    </x-slot>

    @if (isset($cards) && count($cards) > 0)
        <div class="container mt-5">
            <div class="row g-2">
                @foreach ($cards as $card)
                    <div class="text-decoration-none col-3">
                        <div class="card border border-0 shadow-sm p-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $card->topic }}</h5>
                                    <div class="d-flex">
                                        <a href="{{ route('cards.editar', $card) }}" title="Editar"
                                            class="text-decoration-none btn btn-outline-dark rounded-circle border border-0 p-0">
                                            <span class="material-symbols-outlined align-middle m-1">edit</span>
                                        </a>
                                        <button class="btn btn-outline-dark rounded-circle border border-0 p-0">
                                            <span class="material-symbols-outlined align-middle m-1">delete</span>
                                        </button>
                                    </div>
                                </div>
                                <p>{{ $card->question }}</p>
                                <p class="text-end m-0" title="Última atualização">
                                    <small class="text-body-secondary align-middle p-0">
                                        <span class="material-symbols-outlined align-text-bottom" style="font-size: 1rem">update</span> 
                                        {{ $card->updatedDate }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center mt-5">
            <p>Você ainda não tem cards adicionados, <a href="">adicione um</a>.</p>
        </div>
    @endif
</x-app-layout>