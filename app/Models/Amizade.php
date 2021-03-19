<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amizade extends Model
{
    use SoftDeletes;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function primeiro_usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario_1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function segundo_usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario_2');
    }

    public function store($id_usuario_1, $id_usuario_2) {

        $this->id_usuario_1 = $id_usuario_1;
        $this->id_usuario_2 = $id_usuario_2;
        $this->ativa = 0;

        $this->save();
    }

    public function activeFirendship() {
        $this->ativa = 1;

        $this->save();
    }

    public function refuseFirendship() {
        $this->ativa = 0;

        $this->save();
    }
}
