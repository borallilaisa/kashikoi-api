<?php

namespace App\Models;
use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class AssuntoUser extends Model
{
    protected $table = 'assuntos_users';

    protected $fillable = [
        'userID', 'assuntoID', 'tipo'
    ];

    public function assunto() {
        return $this->hasOne(Assunto::class, 'id', 'assuntoID');
    }
}
