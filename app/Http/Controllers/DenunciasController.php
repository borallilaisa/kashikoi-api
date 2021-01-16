<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\User;
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

}
