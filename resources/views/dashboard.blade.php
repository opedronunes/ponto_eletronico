<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h2 class="font-semibold text-lg py-1">Bem vindo ao Ponto Eletrônico</h2>
                        <p>Neste sistema temos o cadastro de usuário e cada usuário registrará o seu ponto, sendo que o mesmo terá acesso apenas ao seus respectivos registros no banco de dados.
                            Dessa forma o registro diário da carga horária de um colaborador conterá os seguintes registros: a data do registro, a entrada, saída ao intervalo, retorno 
                            do intervalo e término do expediente.
                        </p>
                        <p>As possibilidades para aumentar a complexibilidade deste sistema é surpreendente. Abaixo algumas Feautures:</p>
                        <ul class="py-2">
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right bg-green-600 text-white rounded-full text-lg"></i>Cadastro de usuários</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right bg-green-600 text-white rounded-full text-lg"></i>Retorno dos dados individual do usuário</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right bg-green-600 text-white rounded-full text-lg"></i>Inserção da entrada</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right bg-green-600 text-white rounded-full text-lg"></i>Inserção da saída ao intervalo</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right bg-green-600 text-white rounded-full text-lg"></i>Inserção do retorno do intervalo</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right bg-green-600 text-white rounded-full text-lg"></i>Inserção da saída</li>

                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right text-lg"></i> Painel administrativo</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right text-lg"></i> Atualização e exlusão</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right text-lg"></i> Horas extras</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right text-lg"></i> Faltas e justificativas</li>
                            <li class="flex items-center gap-1"><i class="ph-arrow-circle-right text-lg"></i> Níveis de acesso</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
