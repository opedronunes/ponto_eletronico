<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Ponto eletrônico
            </h2>
            <p id="horario" class="text-2xl text-gray-800"></p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($message = Session::get('success'))
                        <div class="text-green-600 py-2 border border-1 border-green-600 rounded-md text-center bg-green-100">
                            {{ $message }}
                        </div>
                    @endif
                
                    <div>
                        <p class="py-2">Registro diário</p>
                        <table class="table w-full text-left">
                            <thead>
                                <tr>
                                    <th>Data registro</th>
                                    <th>Entrada</th>
                                    <th>Saída intervalo</th>
                                    <th>Retorno intervalo</th>
                                    <th>Saída</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if (!$ponto)
                                        <td colspan="5" class="text-center">Vocẽ ainda não registrou o ponto</td>
                                    @else
                                        <td>{{ date("d/m/Y", strtotime($ponto->data_entrada)) }}</td>
                                        <td>{{ $ponto->entrada }}</td>
                                        <td>{{ $ponto->saida_intervalo }}</td>
                                        <td>{{ $ponto->retorno_intervalo }}</td>
                                        <td>{{ $ponto->saida}}</td>
                                        <td>
                                            <form action="{{ route('ponto.destroy', $ponto->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="cursor-pointer w-auto px-1 py-1 text-2xl flex items-center border border-1 rounded hover:bg-red-500 transition-colors"><i class="ph-trash"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    
                        <div class="flex justify-center items-center my-6 gap-2">
                            <form action="{{ route('ponto.store') }}" method="post">
                                @csrf
                                <input type="submit" value="Bater ponto" class="cursor-pointer w-auto px-3 py-1 text-lg border border-1 rounded hover:bg-green-700 hover:text-white transition-colors">
                            </form>
                            
                        </div>
                    </div>
                
                    <p class="py-2">Todos os registros</p>
                
                    <table class="table w-full text-left">
                        <thead>
                            <tr>
                                <th>Data registro</th>
                                <th>Entrada</th>
                                <th>Saída intervalo</th>
                                <th>Retorno intervalo</th>
                                <th>Saída</th>
                                <th>Horas trabalhadas</th>
                                <th>Horas Extra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($todos_pontos) > 0)
                                @foreach ($todos_pontos as $todos_ponto)
                                    <tr>
                                        <td>{{ date("d/m/Y", strtotime($todos_ponto->data_entrada)) }}</td>
                                        <td>{{ $todos_ponto->entrada }}</td>
                                        <td>{{ $todos_ponto->saida_intervalo }}</td>
                                        <td>{{ $todos_ponto->retorno_intervalo }}</td>
                                        <td>{{ $todos_ponto->saida}}</td>
                                        <td>{{ $todos_ponto->worked_time }}</td>
                                        <td> - </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Nenhum ponto encontrado</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    

    