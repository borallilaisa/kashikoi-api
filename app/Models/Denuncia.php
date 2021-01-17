<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denuncia extends Model
{

    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function denunciado() {

        return $this->hasOne(User::class, 'id', 'usuarioDenunciado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function denunciador() {

        return $this->hasOne(User::class, 'id', 'usuarioDenunciador');
    }

    /**
     * @param $data
     */
    public function store($data) {

        $this->usuarioDenunciador  = @$data['usuarioDenunciador'] ?: $this->usuarioDenunciador;
        $this->usuarioDenunciado  = @$data['usuarioDenunciado'] ?: $this->usuarioDenunciado ;
        $this->motivo = @$data['motivo'] ?: $this->motivo;
        $this->observacao = @$data['observacao'] ?: $this->observacao;

        $this->save();

    }
}
