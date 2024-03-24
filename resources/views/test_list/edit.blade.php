<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($list->name . ' | Editar Lista') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-4">
                    <h3 class="mb-4">Preencha os campos abaixo:</h3>
                    <form action="{{ route('listas.update', ['lista' => $list]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row g-1">
                            <div class="col-lg-8 col-md-6 form-floating mb-3 p-0">
                                <input type="text" class="form-control h-100" id="inputName" placeholder="Nome da Lista" name="name" value="{{ $list->name }}" required>
                                <label for="inputName">Digite o nome da lista</label>
                            </div>
                            <div class="col-lg-4 col-md-6 form-floating mb-3 p-0">
                                <input type="color" class="form-control form-control-color w-100" id="inputColor" style="height: 5rem" name="color"  value="{{ $list->color }}">
                                <label for="inputColor">Selecione a cor da capa da lista (Opcional)</label>
                            </div>
                            <div class="col-lg-8 col-md-6 form-floating mb-3 p-0">
                                <input type="url" class="form-control" id="inputUrl" placeholder="Link da imagem de capa (Opcional)" name="url_background" value="{{ $list->url_background }}">
                                <label for="inputUrl">Digite o link para imagem de capa (Opcional)</label>
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