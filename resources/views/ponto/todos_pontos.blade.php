@extends('dashboard.layouts.basic')

@section('title', 'TOdos os registros')
    
@section('content')

    <h1>Todos os registros</h1>
    <table class="table" width="100%">
        <thead>
            <tr>
                <th>Data registro</th>
                <th>Entrada</th>
                <th>Saída intervalo</th>
                <th>Retorno intervalo</th>
                <th>Saída</th>
            </tr>
        </thead>
        <tbody>
            @if (count($todos_pontos) > 0)
                @foreach ($todos_pontos as $todos_ponto)
                    <tr>
                        <td>{{ $todos_ponto->data_entrada }}</td>
                        <td>{{ $todos_ponto->entrada }}</td>
                        <td>{{ $todos_ponto->saida_intervalo }}</td>
                        <td>{{ $todos_ponto->retorno_intervalo }}</td>
                        <td>{{ $todos_ponto->saida}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">Nenhum ponto encontrado</td>
                </tr>
            @endif
        </tbody>
    </table>
    
@endsection