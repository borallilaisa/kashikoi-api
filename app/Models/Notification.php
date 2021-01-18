<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    const NORMAL = 1;
    const NEWFRIEND = 2;
    const BAN = 3;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function amigo() {
        return $this->hasOne(User::class, 'id', 'id_amigo');
    }

    /**
     * @param $data
     */
    public function store($data, $tipo = 1) {

        $this->tipo = $tipo;
        $this->titulo = @$data['titulo'];
        $this->mensagem = @$data['mensagem'];
        $this->id_destinatario = @$data['id_destinatario'];

        $this->save();
    }

    /**
     * @param $data
     */
    public function new_friend($data) {

        $this->tipo = 2;
        $this->titulo = @$data['titulo'];
        $this->mensagem = @$data['mensagem'];
        $this->id_destinatario = @$data['id_destinatario'];
        $this->id_amigo = @$data['id_amigo'];

        $this->save();
    }

    /**
     *
     */
    public function lido() {
        $this->lido_em = \Carbon\Carbon::now()->format('Y-m-d H:s:i');

        $this->save();
    }

}
