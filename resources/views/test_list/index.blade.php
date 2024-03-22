<x-app-layout>
    <x-slot name="header">
        
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Minhas Listas') }}
            </h2>

            <a href="{{ route('listas.create') }}" class="btn btn-outline-dark">Nova Lista</a>
        </div>
    </x-slot>

    @if (count($lists) > 0)
        <div class="container mt-5">
            <div class="row g-2">
                @foreach ($lists as $list)
                    <a href="{{ route('listas.show', $list->id) }}" class="text-decoration-none col-3">
                        <div class="card border border-0 shadow-sm" style="height: auto !important">
                            <img src="{{ $list->url_background ? $list->url_background : asset('assets/img/asking-questions.jpg') }}" class="card-img-top m-0" alt="Capa">
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $list->name }}</h5>
                                <p class="card-text"><small class="text-body-secondary">Última atualização em: {{ $list->updatedDate }}</small></p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center mt-5">
            <p>Você ainda não tem listas adicionadas, <a href="{{ route('listas.create') }}">adicione uma</a>.</p>
        </div>
    @endif
</x-app-layout>