<?php


namespace App\Http\Controllers;

use App\Models\Amizade;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AmizadeController extends Controller {

    /**
     * @param User $user
     * @param Request $request
     * @return false|string
     */
    public function getAllFriendships(User $user, Request $request) {

        $friends = Amizade::select(['id', 'id_usuario_1', 'id_usuario_2', 'ativa'])->
                            orWhere('id_usuario_1', $user->id)->
                            orWhere('id_usuario_2', $user->id)->
                            get();

        return json_encode($friends);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return false|string
     */
    public function list(User $user, Request $request) {

        $friends = Amizade::where('ativa', 1)->
                            where(function($query) use ($user) {
                                return $query->orWhere('id_usuario_1', $user->id)->
                                               orWhere('id_usuario_2', $user->id);
                            })->
                            with(['primeiro_usuario', 'segundo_usuario'])->
                            get();

        return json_encode($friends);
    }

    /**
     * @param User $user
     * @param User $friend
     * @param Request $request
     * @return false|string
     */
    public function unfriend(User $user, User $friend, Request $request) {
        try {
            $friendship = Amizade::where(function($query) use($user) {
                return $query->orWhere('id_usuario_1', $user->id)->
                orWhere('id_usuario_2', $user->id);
            })->
            where(function($query) use($friend) {
                return $query->orWhere('id_usuario_1', $friend->id)->
                orWhere('id_usuario_2', $friend->id);
            })->first();

            if($friendship)
                $friendship->delete();

            return json_encode($friendship);
        }
        catch(\Esception $e) {
            return abort(500, $e->getMessage());
        }
    }

    /**
     * @param User $user
     * @param User $friend
     * @param Request $request
     * @return false|string|void
     */
    public function addFriend(User $user, User $friend, Request $request) {
        try {
            $friendship = Amizade::where(function ($query) use ($user) {
                return $query->orWhere('id_usuario_1', $user->id)->
                orWhere('id_usuario_2', $user->id);
            })->
            where(function ($query) use ($friend) {
                return $query->orWhere('id_usuario_1', $friend->id)->
                orWhere('id_usuario_2', $friend->id);
            })->first();

            $friendship = $friendship ?: new Amizade();

            $friendship->store($user->id, $friend->id);

            $notification = new Notification();

            $message = "O Usuário " . $friend->name . " deseja ser seu amigo!";
            $titulo = "Pedido de Amizade";

            $notification->new_friend(['mensagem' => $message, 'titulo' => $titulo, 'id_destinatario' => $friend->id, 'id_amigo' => $user->id]);

            return json_encode($friendship);
        }
        catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

}
