<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Assunto extends Model {
    use Notifiable;
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assunto_usuarios() {
        return $this->hasMany(AssuntoUser::class, 'assuntoID', 'id');
    }


    public function store($array) {

        $this->titulo = $array['titulo'];
        $this->status = 0;

        $this->save();
    }
}
