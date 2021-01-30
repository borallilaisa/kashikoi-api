@extends('layout.print-layout')
@section('content')
    <br/>
    <p style="font-weight: 600; text-align: center; font-size: 18px">
        Número de Novas Conversas no Últimos 30 Dias
    </p>
    <br/>
    @if(count($conversas) == 0)
        <p style="font-weight: 600; text-align: center; font-size: 18px">
            Nenhum novo usuário registrado nos últimos 30 dias
        </p>
    @endif
    @if(count($conversas) > 0)
        <table border="2" style="border-collapse: collapse; width: 100%">
            <tr>
                <th style="text-align: left">Data</th>
                <th style="text-align: right">Quantidade</th>
            </tr>
            @foreach($conversas as $conversa)
                <tr>
                    <td>
                        {{ $conversa->dia }}/{{ $conversa->month }}/{{ $conversa->year }}
                    </td>
                    <td style="text-align: right">{{ $conversa->total_data }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <br/>
    <br/>
@endsection
