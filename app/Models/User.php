<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usuario_perfil() {
        return $this->hasOne(UsuarioPerfil::class, 'userID', 'id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'id_destinatario', 'id');
    }

    public function assuntos() {
        return $this->hasMany(AssuntoUser::class, 'userID', 'id');
    }

    public function create($data) {

        $this->name = @$data['name'] ?: $this->name;
        $this->level = @$data['level'] ?: $this->level;
        $this->email = @$data['email'] ?: $this->email;
        $this->token = @$data['token'] ?: $this->token;
        $this->password = @$data['password'] ?: $this->password;

        $this->save();

    }
}
