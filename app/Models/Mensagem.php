<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model {

    public function store($message, $destinatario, $emitente, $chat) {

        $this->corpoMensagem = $message;
        $this->idConversa = $chat;
        $this->status = 1;
        $this->idEmitente = $emitente;
        $this->idDestinatario = $destinatario;

        $this->save();
    }
}
