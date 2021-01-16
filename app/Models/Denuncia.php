<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    public function store($data) {

        $this->usuarioDenunciador  = @$data['usuarioDenunciador'] ?: $this->usuarioDenunciador;
        $this->usuarioDenunciado  = @$data['usuarioDenunciado'] ?: $this->usuarioDenunciado ;
        $this->motivo = @$data['motivo'] ?: $this->motivo;
        $this->observacao = @$data['observacao'] ?: $this->observacao;

        $this->save();

    }
}
