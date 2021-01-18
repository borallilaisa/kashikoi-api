<?php


namespace App\Http\Controllers;


use App\Models\Amizade;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificacoesController extends Controller {

    /**
     * @param User $user
     * @param Request $request
     * @return false|string
     */
    public function getAll(User $user, Request $request) {

        return json_encode($user->notifications ? $user->notifications->load(['amigo']) : []);

    }

    /**
     * @param User $user
     * @param Request $request
     * @return false|string
     */
    public function lido(Notification $notification, Request $request) {

        $notification->lido();

        return json_encode($notification);

    }

    /**
     * @param Notification $notification
     * @param Amizade $friendship
     * @param Request $request
     * @return false|string
     */
    public function addFriend(Notification $notification, Amizade $friendship, Request $request) {

        $friendship->activeFirendship();

        $notification->lido();

        return json_encode($notification);
    }

    /**
     * @param Notification $notification
     * @param Amizade $friendship
     * @param Request $request
     * @return false|string
     */
    public function refuseFriend(Notification $notification, Amizade $friendship, Request $request) {

        $friendship->activeFirendship();

        $notification->lido();

        return json_encode($notification);
    }

}
