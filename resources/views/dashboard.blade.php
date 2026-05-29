<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            {{-- // A dashboard é a página inicial do sistema, onde o utilizador é recebido após fazer login. Normalmente, esta página apresenta um resumo das principais informações e funcionalidades disponíveis no sistema, como uma visão geral dos clientes, estatísticas, atalhos para ações comuns (ex: criar novo cliente) e notificações importantes. O objetivo da dashboard é fornecer ao utilizador um ponto de partida centralizado para navegar e interagir com o sistema de forma eficiente. --}}
            <a href="{{ route('client.index') }}" class="btn btn-outline-primary btn-sm px-3">
                Ir para a listagem de clientes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
