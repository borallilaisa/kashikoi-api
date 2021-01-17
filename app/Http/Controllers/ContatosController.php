<?php

namespace App\Http\Controllers;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatosController extends Controller
{
    /**
     * @param Request $request
     * @return false|string|void
     */
    public function saveContato (Request $request){
        try {

            $contato = new Contato();

            $contato->store([
                'email' => $request->email,
                'assunto' => $request->assunto,
                'mensagem' => $request->mensagem
            ]);

            return json_encode($contato);

        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }


    }


    public function findContato(Request $request) {

        $q = $request->q;

        $contatos = Contato::when($q, function($query) use ($q){
            return $query->where('assunto', 'like', "%{$q}%");
        })->get();
        return json_encode($contatos);
    }
}
