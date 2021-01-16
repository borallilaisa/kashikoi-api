<?php


namespace App\Http\Controllers;

use App\ExternalAPI\Pusher\SendMessage;
use App\Models\Conversas;
use App\Models\Mensagem;
use App\Models\User;
use Illuminate\Http\Request;

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

        $chat = Conversas::orWhere(function($query) use ($config) {
                                    return $query->orWhere('usuario_aluno', $config['usuario_aluno'])->
                                                   orWhere('usuario_professor', $config['usuario_aluno']);
                               })->
                               orWhere(function($query) use ($config) {
                                    return $query->orWhere('usuario_aluno', $config['usuario_professor'])->
                                                   orWhere('usuario_professor', $config['usuario_professor']);
                               })->
                               first();

        if(!$chat) {
            $chat = new Conversas();

            $chat->store($request->usuario_aluno, $request->usuario_professor, $request->assunto_id, md5($request->usuario_aluno."-".$request->usuario_professor), true);
        }

        return json_encode($chat);
    }
}
