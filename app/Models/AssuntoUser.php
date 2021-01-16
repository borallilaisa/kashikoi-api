<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AssuntoUser extends Model
{
    protected $table = 'assuntos_users';

    protected $fillable = [
        'userID', 'assuntoID', 'tipo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assunto() {
        return $this->hasOne(Assunto::class, 'id', 'assuntoID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario() {
        return $this->hasOne(User::class, 'id', 'userID');
    }
}
