<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuarioPerfil;
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

            


        }catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }

    }

    public function toMail($notifiable)
    {
        $url = url('/invoice/'.$this->invoice->id);

        return (new MailMessage)
                    ->greeting('Olá!')
                    ->line('Você está recebendo esse e-mail por ter solicitado uma recuperação de senha.')
                    ->action('Clique aqui para recuperar sua senha', $url)
                    ->line('Para mais dúvidas, entre em contato com a equipe Kashikoi.');
    }

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
                                
        if($assuntos) {
            return json_encode($assuntos);
        } 
        else {
            return json_decode([]);
        }

    }
}
