<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioPerfil extends Model {

    protected $table = 'usuario_perfils';

    protected $fillable = [
        'userID', 'textProfile', 'phone', 'score'
    ];

    protected $guarded = [];

    public function store($data) {

        $this->userID = @$data['userID'] ?: $this->userID;
        $this->textProfile = @$data['textProfile'] ?: $this->textProfile;
        $this->phone = @$data['phone'] ?: $this->data;
        $this->score = $this->score ?: 1;

        $this->save();

    }

    /**
     * @param $profile_pic
     */
    public function storeProfilePic($profile_pic) {
        $this->profilePic = $profile_pic;
        $this->save();
    }

    public function createFromOAuth($data) {

        $this->userID = @$data['userID'] ?: $this->userID;
        $this->profilePic = @$this->profilePic ?: @$data['avatar'];

        $this->save();
    }

}
