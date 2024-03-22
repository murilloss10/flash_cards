<x-app-layout>
    <x-slot name="header">
        
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($list->name . ' | Adicionar Card') }}
            </h2>

            <a href="{{ route('listas.show', $list->id) }}" class="btn btn-outline-dark">Voltar</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-4">
                    <h3 class="mb-4">Preencha os campos abaixo:</h3>
                    <form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="{{ $list->id }}" name="test_list_id">
                        
                        <div class="row g-1">
                            <div class="col-lg-12 col-sm-6 form-floating mb-3">
                                <input type="text" class="form-control h-100" id="inputTopic" placeholder="Nome do tópico" name="topic" required>
                                <label for="inputTopic">Digite o tópico</label>
                            </div>
                            <div class="col-lg-12 col-sm-6 form-floating mb-3">
                                <textarea class="form-control" placeholder="Digite a questão" id="inputQuestion" name="question" required></textarea>
                                <label for="inputQuestion">Digite a questão</label>
                            </div>
                            <div class="col-lg-12 col-sm-6 form-floating mb-3">
                                <textarea class="form-control" placeholder="Digite a resposta da questão" id="inputQuestionAnswer" name="question_answer"></textarea>
                                <label for="inputQuestionAnswer">Digite a resposta da questão</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-dark" type="submit">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>