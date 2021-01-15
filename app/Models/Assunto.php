<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Assunto extends Model {
    use Notifiable;
    use SoftDeletes;


    public function store($array) {

        $this->titulo = $array['titulo'];
        $this->status = 0;

        $this->save();
    }
}
