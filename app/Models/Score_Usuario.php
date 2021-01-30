<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Score_Usuario extends Model
{

    protected $table = 'score_usuario';
    use Notifiable;
    use SoftDeletes;
    public function store($data) {



        $this->score  = @$data['score'] ?: $this->score;
        $this->idRemetente  = @$data['idRemetente'] ?: $this->idRemetente ;
        $this->idDestinatario = @$data['idDestinatario'] ?: $this->idDestinatario;


        $this->save();

    }
}
