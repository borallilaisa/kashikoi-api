<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Conversas extends Model {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aluno() {
        return $this->hasOne(User::class, 'id', 'usuario_aluno');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function professor() {
        return $this->hasOne(User::class, 'id', 'usuario_professor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assunto() {
        return $this->hasOne(Assunto::class, 'id', 'idAssunto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mensagens() {
        return $this->hasMany(Mensagem::class, 'idConversa', 'id');
    }

    public function store($id_aluno, $id_professor, $new = false) {

        $this->usuario_aluno = $id_aluno;
        $this->usuario_professor = $id_professor;
        if($new)
            $this->data_inicio = Carbon::now()->format('Y-m-d H:i:s');

        $this->save();
    }
}
