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
            <div class="row g-2 h-100">
                @foreach ($lists as $list)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card border border-0 shadow-sm">
                            <img src="{{ $list->url_background ? $list->url_background : asset('assets/img/asking-questions.jpg') }}"
                            class="card-img-top m-0 img-card" style="min-height: 15rem !important; width: auto !important; object-fit: cover;" alt="Capa">
                            
                            <div class="position-absolute top-0 end-0 d-flex p-1">
                                <span class="btn btn-outline-light material-symbols-outlined p-1 m-1 rounded-circle" 
                                    onclick="editPage({{ $list }})" title="Editar">edit</span>
                                <span class="btn btn-outline-light material-symbols-outlined p-1 m-1 rounded-circle"
                                    title="Excluir" data-bs-toggle="modal" data-bs-target="#listDelete{{ $list->id }}">delete</span>
                                <div class="modal p-4 py-md-5" tabindex="-1" role="dialog" id="listDelete{{ $list->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content rounded-4 shadow">
                                            <div class="modal-header border-bottom-0">
                                                <h1 class="modal-title fs-5">{{ $list->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-0">
                                                <p>Deseja excluir a lista <b>{{ $list->name }}</b> ?</p>
                                            </div>
                                            <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                                <a href="{{ route('listas.deletar', ['lista' => $list]) }}" class="btn btn-lg btn-primary">Confirmar</a>
                                                <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('listas.show', $list->id) }}" class="text-decoration-none">
                                <div class="card-body h-100">
                                    <h5 class="card-title">{{ $list->name }}</h5>
                                    <p class="card-text"><small class="text-body-secondary">Última atualização em: {{ $list->updatedDate }}</small></p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center mt-5">
            <p>Você ainda não tem listas adicionadas, <a href="{{ route('listas.create') }}">adicione uma</a>.</p>
        </div>
    @endif
</x-app-layout>

<style>
    .card:hover {
        transition: ease-out;
        box-shadow: 0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.075) !important;
    }
</style>

<script>
    function editPage(list) {
        window.location.href = `/listas/${list['id']}/editar`;
    }
</script>