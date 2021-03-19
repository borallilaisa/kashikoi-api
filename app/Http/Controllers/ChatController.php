<?php


namespace App\Http\Controllers;

use App\ExternalAPI\Pusher\SendMessage;
use App\Models\Assunto;
use App\Models\Conversas;
use App\Models\Mensagem;
use App\Models\Score_Usuario;
use App\Models\User;
use App\Models\UsuarioPerfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller {

    /**
     * @param User $professor
     * @param User $aluno
     * @param Request $request
     * @return false|string
     */
    public function openChat($hash, Request $request) {

        $conversa = Conversas::where('hash', $hash)->first();

        $conversa = $conversa->load(['aluno', 'aluno.usuario_perfil', 'professor', 'professor.usuario_perfil']) ?: [];

        return json_encode($conversa);
    }

    /**
     * @param User $aluno
     * @param Request $request
     */
    public function getMessages(Conversas $chat, Request $request) {

        $messages = $chat->mensagens()->orderBy('id', 'desc')->paginate(10) ?: [];

        return json_encode($messages);
    }

    /**
     * @param Conversas $chat
     * @param Request $request
     * @return false|string
     */
    public function sendMessage(Conversas $chat, Request $request) {

        $message = new Mensagem();

        $message->store($request->mensagem, $request->idDestinatario, $request->idRemetente, $chat->id);

        $send_message = new SendMessage();

        $channel_event = $chat->hash;

        $send_message->callMessage($message, 'chat-channel', $channel_event);

        return json_encode($message);

    }




    public function sendScore(User $remetente, User $destinatario, Request $request) {

        $score = Score_Usuario::where('idDestinatario', $destinatario->id)->
                                where('idRemetente', $remetente->id)->
                                first();

        $score = $score ?: new Score_Usuario();

        $score->store([
                'score' => $request->score,
                'idRemetente'=> $remetente->id,
                'idDestinatario'=> $destinatario->id
            ]
        );


        $scoreNew = Score_Usuario::select(DB::raw('ROUND(SUM(score) / COUNT(id)) AS media' ))->
                                      where('idDestinatario', '=', $destinatario->id)->
                                      first();



        $usuario = UsuarioPerfil::where('userID', $destinatario->id)->first();

        if($usuario) {

           $usuario->score = $scoreNew->media;

            $usuario->update();

            return json_encode($usuario);

        }
        else {
            return abort(404, "Não Encontrado");
        }


        return json_encode($scoreNew);

    }

    public function listChat(User $user, Request $request) {

        $chats = Conversas::orWhere('usuario_aluno', $user->id)->
                            orWhere('usuario_professor', $user->id)->

                            with(['aluno', 'professor', 'assunto', 'mensagens' => function($query) {
                                return $query->latest()->first();
                            }])->
                            get();

        $chats = count($chats) > 0 ? $chats : [];

        return json_encode($chats);
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function newChat(Request $request) {

        $config = $request->all();

        $chat = Conversas::where(function($query) use ($config) {
                                    return $query->where('usuario_aluno', $config['usuario_aluno'])->
                                                   orWhere('usuario_professor', $config['usuario_aluno']);
                               })->
                               where(function($query) use ($config) {
                                    return $query->where('usuario_aluno', $config['usuario_professor'])->
                                                   orWhere('usuario_professor', $config['usuario_professor']);
                               })->
                               first();

        if(!$chat) {
            $chat = new Conversas();

            $chat->store($request->usuario_aluno, $request->usuario_professor, $request->assunto_id, md5($request->usuario_aluno."-".$request->usuario_professor), true);
        }

        return json_encode($chat);
    }

    /**
     * @param User $friend
     * @param User $user
     * @param Request $request
     * @return false|string
     */
    public function startChatByFriend(User $friend, User $user, Request $request) {

        $chat = Conversas::orWhere(function($query) use($friend) {
                                return $query->orWhere('usuario_aluno', $friend->id)->
                                orWhere('usuario_professor', $friend->id);
                            })->
                            orWhere(function($query) use ($user) {
                                return $query->orWhere('usuario_aluno', $user->id)->
                                orWhere('usuario_professor', $user->id);
                            })->
                            first();

        $chat = $chat ?: [];

        return json_encode($chat);

    }
}
