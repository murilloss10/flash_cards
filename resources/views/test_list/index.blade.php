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
                                    onclick="fillModalInitialTest({{ $list }})" data-bs-target="#modalInitialTest" data-bs-toggle="modal" title="Fazer teste">quiz</span>
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

    <div class="modal fade" id="modalInitialTest" aria-hidden="true" aria-labelledby="modalInitialTestLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5" id="modalInitialTestLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    Clique em "Iniciar" para começar o teste.
                </div>
                <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                    <button class="btn btn-lg btn-primary" data-bs-target="#modalTest" data-bs-toggle="modal">Iniciar</button>
                    <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTest" aria-hidden="true" aria-labelledby="modalTestLabel" tabindex="-1"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="d-flex justify-content-between m-2">
                    <p class="d-none" id="p-card-id"></p>
                    <p id="p-topic"></p>
                    <p id="p-list-name"></p>
                </div>
                <div class="modal-body row align-items-center justify-content-center m-1 p-0 flip-card">
                    <div class="flip-card-inner p-0">
                        <div class="col-12 row align-items-center bg-primary bg-gradient rounded-4 m-0 p-2" id="div-question">
                            <h3 class="text-center mt-2 col-12 align-self-start" id="p-question"></h3>
                            <p class="text-center col-12 align-self-end" style="font-size: .75rem">Clique para ver a resposta.</p>
                        </div>
                        <div class="col-12 row align-items-center bg-success bg-gradient rounded-4 m-0 p-2" id="div-question-answer">
                            <h3 class="text-center mt-2 col-12 align-self-start" id="p-question-answer"></h3>
                            <p class="text-center col-12 align-self-end" style="font-size: .75rem">Clique para ver a questão.</p>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer border border-0 d-flex justify-content-between">
                    <div class="d-flex">
                        <button class="btn btn-primary ml-1" data-bs-target="#modalInitialTest" data-bs-toggle="modal">
                            Voltar
                        </button>
                        <h1 class="modal-title p-2 fs-5" id="modalTestLabel">1/10</h1>
                    </div>
                    <div class="d-flex" id="buttonsCard">
                        <button class="btn btn-primary p-2 m-1" id="previous-card">
                            <span class="material-symbols-outlined align-middle">arrow_back_ios</span>
                        </button>
                        <button class="btn btn-primary p-2 m-1" id="next-card">
                            <span class="material-symbols-outlined align-middle">arrow_forward_ios</span>
                        </button>
                        <div>
                            <form action="{{ route('listas.teste.finalizar', ) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="text" class="d-none" name="test_list_id" id="input_test_list_id">
                                <input type="integer" class="d-none" name="corrects" id="input_corrects">
                                <input type="integer" class="d-none" name="incorrects" id="input_incorrects">
                                <input type="integer" class="d-none" name="total_questions" id="input_total_questions">

                                <button type="submit" class="btn btn-primary p-2 m-1 d-none" id="result">
                                    Finalizar <span class="material-symbols-outlined align-middle">assignment_turned_in</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .card:hover {
        transition: ease-out;
        box-shadow: 0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.075) !important;
    }

    .flip-card {
        width: 100%;
        height: 20rem;
        perspective: 2000px;
    }

    .flip-card-inner {
        position: relative;
        width: 80%;
        height: 100%;
        cursor: pointer;
        transform-style: preserve-3d;
        transform-origin: center right;
        transition: transform 1s;
    }

    .flip-card-inner.is-flipped {
        transform: translateX(-100%) rotateY(-180deg);
    }

    #div-question, #div-question-answer {
        position: absolute;
        width: 100%;
        height: 100%;
        color: white;
        backface-visibility: hidden;
    }

    #div-question-answer {
        transform: rotateY(180deg);
    }
</style>

<script src="{{ asset('assets/js/index_test_list.js') }}"></script>