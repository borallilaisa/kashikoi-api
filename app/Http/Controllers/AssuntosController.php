<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assunto;
use App\Models\User;
use App\Models\AssuntoUser;

class AssuntosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->verificarNaoExiste($request->aprender);
            $this->verificarNaoExiste($request->ensinar);

            $aprender = $this->abstrairArray($request->aprender);
            $ensinar = $this->abstrairArray($request->ensinar);

            $user = User::where('token', $request->token)->first();
            $checkAssuntos = AssuntoUser::where('userID', $user->id)->get();

            if($checkAssuntos && count($checkAssuntos) > 0) {
                foreach($checkAssuntos as $check) {
                    $check->delete();
                }
            }

            foreach($aprender as $data) {
                $AssuntoUsers = new AssuntoUser([
                    'userID' => $user->id,
                    'assuntoID' => $data,
                    'tipo' => 1

                ]);

                $AssuntoUsers->save();
            }

            foreach($ensinar as $data) {
                $AssuntoUsers = new AssuntoUser([
                    'userID' => $user->id,
                    'assuntoID' => $data,
                    'tipo' => 2
                ]);

                $AssuntoUsers->save();
            }

            $checkAssuntos = AssuntoUser::where('userID', $user->id)->get();

            return json_encode($checkAssuntos);

        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    public function verificarNaoExiste($array) {
        $aux = [];
        foreach($array as $item) {
            $assunto = Assunto::where('titulo', $item)->get();
            if(count($assunto) == 0) {
                $aux_assunto = new Assunto();
                $aux_assunto->store(['titulo' => $item]);
            }
        }
    }


    public static function abstrairArray($array) {
        $assuntos = Assunto::whereIn('titulo', $array)->
                             get();

            $aux = [];

            foreach($assuntos as $assunto)
                $aux[] = $assunto->id;

            return $aux;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request) {
        try {

            if($request->token) {

                $q = $request->q;

                $assuntos = Assunto::when($q, function($query) use ($q) {
                    $query->where('titulo', 'like', '%'.$q.'%');
                })->
                get();

                if($assuntos) {
                    return json_encode($assuntos);

                }

            }
            else {
                return response('Hello World', 404);
            }

        }
        catch(\Exception $e) {

            return ["message" => $e];
        }
    }


    public function findAssuntosUser(Request $request) {
        try {

                $user = User::where('token', $request->token)->first();

                $assuntos = $user->assuntos->load(['assunto']);

                if($assuntos) {
                    return json_encode($assuntos);
                }
                else {
                    return json_decode([]);
                }

        }
        catch(\Exception $e) {

            return ["message" => $e];
        }
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
