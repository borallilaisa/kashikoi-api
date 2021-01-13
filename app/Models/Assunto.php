<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model {

    public function store($array) {

        $this->titulo = $array['titulo'];
        $this->status = 0;

        $this->save();
    }
}
