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
    public function openChat(User $professor, User $aluno, Request $request) {

        $conversa = Conversas::where('usuario_aluno', $aluno->id)->
                               where('usuario_professor', $professor->id)->
                               where('ativa', 1)->
                               first();

        if(!$conversa) {
            $conversa = new Conversas();
            $conversa->store($aluno->id, $professor->id, true);
        }

        $conversa = $conversa->load(['aluno', 'professor']) ?: [];

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

        $channel_event = 'chat-a'.$chat->usuario_aluno.'-p'.$chat->usuario_professor;

        $send_message->callMessage($message, 'chat-channel', $channel_event);

        return json_encode($message);

    }
}
