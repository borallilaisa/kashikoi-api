<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Contato extends Model
{

    protected $table = 'contato';

    protected $fillable = [
        'email', 'assunto', 'mensagem'
    ];

    use Notifiable;
    use SoftDeletes;

    public function store($data) {

        $this->email = @$data['email'] ?: $this->email;
        $this->assunto = @$data['assunto'] ?: $this->assunto;
        $this->mensagem = @$data['mensagem'] ?: $this->mensagem;

        $this->save();

    }
}
