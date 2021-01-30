@extends('layout.print-layout')
@section('content')
    <br/>
    <p style="font-weight: 600; text-align: center; font-size: 18px">
        Número de Novos Usuários Nos últimos 30 dias
    </p>
    <br/>
    @if(count($usuarios) == 0)
        <p style="font-weight: 600; text-align: center; font-size: 18px">
            Nenhum novo usuário registrado nos últimos 30 dias
        </p>
    @endif
    @if(count($usuarios) > 0)
        <table border="2" style="border-collapse: collapse; width: 100%">
            <tr>
                <th style="text-align: left">Data</th>
                <th style="text-align: right">Quantidade</th>
            </tr>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>
                        {{ $usuario->dia }}/{{ $usuario->month }}/{{ $usuario->year }}
                    </td>
                    <td style="text-align: right">{{ $usuario->total_data }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <br/>
    <br/>
@endsection
