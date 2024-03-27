<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-4">
                    <h2 class="text-center mb-5">Olá, {{ $user->name }}!</h2>
                    <div class="d-flex justify-content-center mt-5">
                        <a href="{{ route('listas.index') }}" class="btn btn-outline-dark btn-lg">Acesse suas listas clicando aqui.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
