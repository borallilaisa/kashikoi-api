<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Conversas extends Model {

    use Notifiable;
    use SoftDeletes;

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

    public function store($id_aluno, $id_professor, $assunto, $hash, $new = false) {

        $this->usuario_aluno = $id_aluno;
        $this->usuario_professor = $id_professor;
        $this->idAssunto = $assunto;
        $this->hash = $hash;
        if($new)
            $this->data_inicio = Carbon::now()->format('Y-m-d H:i:s');

        $this->save();
    }
}
