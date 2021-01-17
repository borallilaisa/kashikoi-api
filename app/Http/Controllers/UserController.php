<?php

namespace App\Http\Controllers;
use App\Models\Assunto;
use App\Models\AssuntoUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuarioPerfil;
use App\Notifications\RecoverPassword;
use Keygen;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('AAAAA');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function store(Request $request) {

            try {
                $v = $request->validate([
                    'nome'=>'required',
                    'email'=>'required',
                    'senha'=>'required'
                ]);

                $total = 1 + 1;

                $aux = User::where('email', $request->email)->get();

                if(count($aux) > 0)
                    abort(500, "E-mail já utilizado");

                $user = new User();

                $id = Keygen::numeric(10)->generate();

                $data = [
                    'name' => $request->nome,
                    'level' => "1",
                    'email' => $request->email,
                    'token' => $id,
                    'password' => md5($request->senha)
                ];

                $user = new User();

                $user->create($data);

                $usuario_perfil = new UsuarioPerfil();

                $data = [
                    'userID' => $user->id
                ];

                $usuario_perfil::unguard();

                $usuario_perfil->create($data);

                 return json_encode($user);


            }
            catch(\Exception $e) {
                return abort(500, $e->getMessage());

            }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {

        try {
            $v = $request->validate([
                'email'=>'required',
                'senha'=>'required'
            ]);

            $user = User::where('email', $request->email)->
                            where('password', md5($request->senha))->
                            first();

            if($user) {
                return json_encode($user);

            }
            return abort(404, "Usuário não encontrado");
        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarusuario(Request $request)
    {

        if($request->token) {

            $user = User::where('token', $request->token)
                            ->with(['usuario_perfil'])
                            ->first();

            if($user)
                return json_encode($user);
            else
                abort(404);

        }

    }

    public function salvarinfoPerfil(Request $request) {
        try {

            $v = $request->validate([
                'name' => 'required',
                'email'=>'required',
                'password'=>'required'
            ]);

            $user = User::where('token', $request->token)
            ->where('password', md5($request->password))
            ->first();

            if(!$user)
                abort(404);
            else {
                $data = [
                    'name' => $request->name,
                    'email' => $request->email
                ];

                $user->create($data);

                $data = [
                    'userID' => $user->id,
                    'textProfile' => $request->usuario_perfil['textProfile'],
                    'phone' => $request->usuario_perfil['phone']
                ];

                $usuario_perfil = UsuarioPerfil::where('userID', $user->id) ->first();

                $usuario_perfil::unguard();

                $usuario_perfil->update($data);

                return json_encode($user->load(['usuario_perfil']));
            }
        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());

        }

    }

    public function recuperarSenha(Request $request){
        try{

            $user = User::where('email', $request->email)->
                          first();


            if($user) {

                $user->senhaToken = md5(str_shuffle($user->token));
                $user->save();

                $user->notify(new RecoverPassword());

                return json_encode($user);

            }
            else {
                return abort(404, "Não Encontrado");
            }


        }catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }

    }

    public function recuperarSenhaFinalizar(Request $request){
        try{

            $user = User::where('senhaToken', $request->token)->
                          first();


            if($user) {

                $user->password = md5(($request->senha));
                $user->senhaToken = null;
                $user->save();

                return json_encode($user);

            }
            else {
                return abort(404, "Não Encontrado");
            }


        }catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }

    }

    /**
     * @param Request $request
     * @return false|string|void
     */
    public function uploadPhoto(Request $request){
        try {
            if(!$request->foto) {
                abort(500);
            }
            else {

                $user = User::where('token', $request->token)->first();

                $usuario_perfil = UsuarioPerfil::where('userID', $user->id) ->first();

                $usuario_perfil::unguard();

                $usuario_perfil->profilePic = $request->foto;

                $usuario_perfil->save();

                return json_encode($user->load(['usuario_perfil']));
            }
        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }
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
        $request->validate([
            'userName'=>'required',
            'userEmail'=>'required',
            'userPass'=>'required'
    ]);

    $contact = Contact::find($id);
    $contact->first_name =  $request->post('userName');
    $contact->last_name = $request->post('userEmail');
    $contact->email = $request->post('userPass');
    $contact->save();

    return redirect('/user')->with('success', 'Usuario atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('/user')->with('success', 'Usuário deletado!');
    }

    public function getUserById(User $user, Request $request) {

        return json_encode($user->load(['usuario_perfil']));
    }

    public function getAssuntosByUser(User $user, Request $request) {

        $assuntos = $user->assuntos->load(['assunto']);

        return $assuntos ? json_encode($assuntos) : json_decode([]);

    }


    public function find(Request $request) {

        $q = $request->q;

        $users = User::when($q, function ($query) use ($q) {
                    return $query->orWhere('name', 'like', "%{$q}%")->
                            orWhere('email', 'like', "%{$q}%");
                    })->
                    withTrashed()->
                    with(['usuario_perfil'])->get();

        $users = $users ?: [];

        return json_encode($users);
    }

    public function softDeleteUser(Request $request) {

        $user = User::where('id', $request->id)->first();

        if($user) {

            $user->delete();

            return json_encode($user->load(['usuario_perfil']));

        }
        else {
            return abort(404, "Não Encontrado");
        }



    }

    public function unblockUser(Request $request) {

        $user = User::where('id', $request->id)->withTrashed()->first();

        if($user) {

            $user->deleted_at = null;
            $user->save();

            return json_encode($user->load(['usuario_perfil']));

        }
        else {
            return abort(404, "Não Encontrado");
        }

    }

    /**
     * @param Assunto $assunto
     * @param $tipo_assunto
     * @param Request $request
     * @return false|string
     */
    public function getUserByAssuntos(User $user, Assunto $assunto, $tipo_assunto, Request $request) {

        $assuntos_users = $assunto->assunto_usuarios()->
                                    where('tipo', $tipo_assunto)->
                                    where('userID', '<>', $user->id)->
                                    with(['usuario'])->get();

        return json_encode($assuntos_users);

    }
}
