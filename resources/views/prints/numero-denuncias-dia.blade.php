@extends('layout.print-layout')
@section('content')
    <br/>
    <p style="font-weight: 600; text-align: center; font-size: 18px">
        Número de Denuncias Nos últimos 30 dias
    </p>
    <br/>
    @if(count($denuncias) == 0)
        <p style="font-weight: 600; text-align: center; font-size: 18px">
            Nenhuma Denúncia encontrada nos últimos 30 dias
        </p>
    @endif
    @if(count($denuncias) > 0)
        <table border="2" style="border-collapse: collapse; width: 100%">
            <tr>
                <th style="text-align: left">Data</th>
                <th style="text-align: right">Quantidade</th>
            </tr>
            @foreach($denuncias as $denuncia)
                <tr>
                    <td>
                        {{ $denuncia->dia }}/{{ $denuncia->month }}/{{ $denuncia->year }}
                    </td>
                    <td style="text-align: right">{{ $denuncia->total_data }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <br/>
    <br/>
@endsection
