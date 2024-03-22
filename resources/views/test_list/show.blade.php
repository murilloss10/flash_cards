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
                                        <button type="button" class="btn btn-outline-dark rounded-circle border border-0 p-0" data-bs-toggle="modal" data-bs-target="#cardDelete{{ $card->id }}">
                                            <span class="material-symbols-outlined align-middle m-1">delete</span>
                                        </button>
                                        <div class="modal p-4 py-md-5" tabindex="-1" role="dialog" id="cardDelete{{ $card->id }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-4 shadow">
                                                    <div class="modal-header border-bottom-0">
                                                        <h1 class="modal-title fs-5">{{ $card->topic }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body py-0">
                                                        <p>Deseja excluir o card <b>{{ $card->topic }}</b> ?</p>
                                                    </div>
                                                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                                        <a href="{{ route('cards.deletar', $card) }}" class="btn btn-lg btn-primary">Confirmar</a>
                                                        <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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