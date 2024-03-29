<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;
use Minishlink\WebPush\WebPush;

class OrderComplete implements ShouldBroadcast //Agregamos "implements ShouldBroadcast"
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ecommerce-channel'); // Cambiamos PrivateChannel por solo Channel e indicamos nombre del canal
    }

//Agregamos funcion que retorna el evento
    /**
     * Broadcast event order-complete
     *
     * @return string
     */
    public function broadcastAs(){
        return 'order-complete';
    }

        /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
       /* $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);

        return [
             $pusher->trigger('ecommerce-channel', 'order-complete', ['name' => 'Nuevo mensaje'])
        ];
        */
        
        return [
            'name' =>  $this->name
       ];
       
    }

}
