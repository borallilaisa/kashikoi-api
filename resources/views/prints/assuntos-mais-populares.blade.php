@extends('layout.print-layout')
@section('content')
    <br/>
    <p style="font-weight: 600; text-align: center; font-size: 18px">
        Assuntos Mais Populares
    </p>
    <br/>
    <table border="2" style="border-collapse: collapse; width: 100%">
        <tr>
            <th style="text-align: left">Titulo</th>
            <th style="text-align: right">Quantidade de Conversas</th>
        </tr>
        @foreach($assuntos as $assunto)
            <tr>
                <td>
                    {{ $assunto->titulo }}
                </td>
                <td style="text-align: right">{{ $assunto->quantidade }}</td>
            </tr>
        @endforeach
    </table>
    <br/>
    <br/>
@endsection
