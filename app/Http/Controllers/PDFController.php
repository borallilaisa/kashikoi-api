<?php


namespace App\Http\Controllers;

use App\Models\Amizade;
use App\Models\Conversas;
use App\Models\Denuncia;
use App\Models\Mensagem;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller {

    /**
     * @param Request $request
     * @return mixed
     */
    public function printPdf(Request $request) {

        $user = User::first();

        $pdf = PDF::loadView('prints.test-print', compact('user'));

        return $pdf->download('invoice.pdf');

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function numeroConversasDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(30);

        $conversas = Mensagem::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
                               where('created_at', '>=', $week)->
                               where('created_at', '<=', $actual_date)->
                               groupBy('dia')->
                               groupBy('month')->
                               groupBy('year')->
                               orderBy('created_at')->
                               get();

        $pdf = PDF::loadView('prints.numero-conversas-dia', compact('conversas'));

        return $pdf->download('numero-mensagens-dia.pdf');

    }

    public function numeroAmizadesDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(30);

        $amizades = Amizade::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $week)->
        where('created_at', '<=', $actual_date)->
        groupBy('dia')->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        get();

        $pdf = PDF::loadView('prints.numero-amizades-dia', compact('amizades'));

        return $pdf->download('numero-amizades-dia.pdf');

    }

    public function numeroUsuarioDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(30);

        $usuarios = User::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $week)->
        where('created_at', '<=', $actual_date)->
        groupBy('dia')->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        withTrashed()->
        get();

        $pdf = PDF::loadView('prints.numero-usuarios-dia', compact('usuarios'));

        return $pdf->download('numero-usuarios-dia.pdf');

    }

    public function numeroDenunciaDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(30);

        $denuncias = Denuncia::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $week)->
        where('created_at', '<=', $actual_date)->
        groupBy('dia')->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        withTrashed()->
        get();

        $pdf = PDF::loadView('prints.numero-denuncias-dia', compact('denuncias'));

        return $pdf->download('numero-denuncias-dia.pdf');

    }

    public function assuntosMaisPopulares(Request $request) {

        $assuntos = Conversas::select(DB::raw('COUNT(assuntos.id) as quantidade, assuntos.titulo as titulo'))->
        join('assuntos', function($join) {
            $join->on('conversas.idAssunto', '=', 'assuntos.id');
        })->
        groupBy('titulo')->
        limit(10)->
        get();

        $pdf = PDF::loadView('prints.assuntos-mais-populares', compact('assuntos'));

        return $pdf->download('assuntos-mais-populares.pdf');
    }

    public function totalConversasTrimestre(Request $request) {

        $actual_date = Carbon::now();

        $month = Carbon::now()->subMonths(3);

        $conversas = Conversas::select(DB::raw('COUNT(id) as total_data, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $month)->
        where('created_at', '<=', $actual_date)->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        get();

        $pdf = PDF::loadView('prints.total-conversas-trimestre', compact('conversas'));

        return $pdf->download('total-conversas-trimestre.pdf');
    }

}
