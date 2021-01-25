<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\AvisarDenunciado;
use Illuminate\Http\Request;

class DenunciasController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function sendDenuncia(User $denunciador, User $denunciado, Request $request){
        try {


            $denuncia = new Denuncia();

            $denuncia->store([
                'usuarioDenunciador' => $denunciador->id,
                'usuarioDenunciado' => $denunciado->id,
                'motivo' => $request->motivo,
                'observacao' => $request->observacao
            ]);


            return json_encode($denuncia);

        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    public function listarDenuncias(Request $request) {

        $q = $request->q;

        $denuncias = Denuncia::when($q, function($query) use ($q){
                                return $query->where('motivo', 'like', "%{$q}%");
                            })->with(['denunciado','denunciador'])->get();
        return json_encode($denuncias);
    }

    public function confirmDenuncia(Denuncia $denuncia, Request $request) {

        $denuncia->denunciado->delete();


        $denuncia->denunciado->notify(new AvisarDenunciado());


        $denuncia->delete();


        $outrasDenuncias = Denuncia::when($denuncia, function($query) use ($denuncia){
            return $query->where('usuarioDenunciado', $denuncia->denunciado->id);
        })->get();

        foreach($outrasDenuncias as $OutraDenuncia) {
            $OutraDenuncia->delete();
        }



        return json_encode($denuncia);
        return json_encode($outrasDenuncias);
    }

    public function ignoreDenuncia(Denuncia $denuncia, Request $request) {

      $denuncia->delete();


        $notification = new Notification();

        $notification->store([
            'titulo' => 'Resposta de Análise de Denuncia',
            'mensagem' => 'Olá! Sua denuncia foi analisada e por não encontrarmos nenhuma irregularidade, então descartamos seu registro. Caso possua alguma dúvida, por gentileza, entrar em contato com a equipe Kashikoi.',
            'id_destinatario' => $denuncia->usuarioDenunciador
        ]);

        return json_encode($denuncia);

    }



}
