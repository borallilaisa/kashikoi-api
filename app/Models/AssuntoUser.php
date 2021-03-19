<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class AssuntoUser extends Model
{
    protected $table = 'assuntos_users';

    protected $fillable = [
        'userID', 'assuntoID', 'tipo'
    ];

    use Notifiable;
    use SoftDeletes;

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
