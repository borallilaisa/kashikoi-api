@extends('layout.print-layout')
@section('content')
    <br/>
    <p style="font-weight: 600; text-align: center; font-size: 18px">
        Número de Novas Amizades Nos Últimos 30 dias
    </p>
    <br/>
    @if(count($amizades) == 0)
        <p style="font-weight: 600; text-align: center; font-size: 18px">
            Nenhuma nova amizade registrada nos últimos 30 dias
        </p>
    @endif
    @if(count($amizades) > 0)
        <table border="2" style="border-collapse: collapse; width: 100%">
            <tr>
                <th style="text-align: left">Data</th>
                <th style="text-align: right">Quantidade</th>
            </tr>
            @foreach($amizades as $amizade)
                <tr>
                    <td>
                        {{ $amizade->dia }}/{{ $amizade->month }}/{{ $amizade->year }}
                    </td>
                    <td style="text-align: right">{{ $amizade->total_data }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <br/>
    <br/>
@endsection
