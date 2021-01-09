<?php


namespace App\ExternalAPI\Pusher;

use Pusher\Pusher;


class SendMessage {


    public function config() {

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );

        return $options;
    }

    public function callMessage($message, $channel, $event) {

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $this->config()
        );

        $data['message'] = $message;

        $pusher->trigger($channel, $event, $data);

    }

}
