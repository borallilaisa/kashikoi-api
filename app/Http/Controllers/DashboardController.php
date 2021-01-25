<?php


namespace App\Http\Controllers;


use App\Models\Conversas;
use App\Models\Denuncia;
use App\Models\Mensagem;
use App\Models\Amizade;
use App\Models\User;

use App\Models\UsuarioPerfil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    /**
     * @param Request $request
     * @return false|string
     */
    public function numeroConversasDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(7);

        $conversas = Mensagem::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
                                where('created_at', '>=', $week)->
                                where('created_at', '<=', $actual_date)->
                                groupBy('dia')->
                                groupBy('month')->
                                groupBy('year')->
                                orderBy('created_at')->
                                get();

        return json_encode($conversas);

    }


    public function numeroAmizadesDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(7);

        $amizades = Amizade::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $week)->
        where('created_at', '<=', $actual_date)->
        groupBy('dia')->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        get();

        return json_encode($amizades);

    }

    public function numeroUsuarioDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(7);

        $usuario = User::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $week)->
        where('created_at', '<=', $actual_date)->
        groupBy('dia')->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        withTrashed()->
        get();

        return json_encode($usuario);

    }

    public function numeroDenunciaDia(Request $request) {

        $actual_date = Carbon::now();

        $week = Carbon::now()->subDays(7);

        $usuario = Denuncia::select(DB::raw('COUNT(id) as total_data, EXTRACT(DAY from created_at) as dia, EXTRACT(MONTH from created_at) as month, EXTRACT(YEAR from created_at) as year'))->
        where('created_at', '>=', $week)->
        where('created_at', '<=', $actual_date)->
        groupBy('dia')->
        groupBy('month')->
        groupBy('year')->
        orderBy('created_at')->
        withTrashed()->
        get();

        return json_encode($usuario);

    }

    public function assuntosMaisPopulares(Request $request) {
       /* $assuntos = DB::raw(
            'SELECT
                    COUNT(a.id) as quantidade,
                    a.titulo as titulo
                    from conversas c
                    join assuntos a on a.id = c.idAssunto
                    where c.deleted_at is null
                    group by titulo desc
                    limit 5'
        );*/

        $assuntos = Conversas::select(DB::raw('COUNT(assuntos.id) as quantidade, assuntos.titulo as titulo'))->
                               join('assuntos', function($join) {
                                   $join->on('conversas.idAssunto', '=', 'assuntos.id');
                               })->
                               groupBy('titulo')->
                               limit(5)->
                               get();

        return json_encode($assuntos);
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

        return json_encode($conversas);




    }

}
