<?php

namespace App\Http\Controllers;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatosController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function saveContato (Request $request){
        try {


                $contato = new Contato([
                    'email' => $request->id,
                    'assunto' => $request->assunto,
                    'mensagem' => $request->mensagem

                ]);

              $contato->store($contato);




            return json_encode($contato);

        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }


    }
}
