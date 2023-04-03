<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public $user;
    public $message;

    public function __construct( Message $message)
    {
        // $this->user = $user;
        $this->message = $message;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // $other_user = $this->message->conversation->participants()
        //     ->where('user_id', '<>', $this->message->user_id)
        //     ->first();

        // return new PresenceChannel('channel-chat.' . $other_user->id);
        $order_id= $this->message->order_id;

        return new Channel('chat.'. $order_id);
    }

    public function broadcastAs()
    {
        return 'new-message';
    }
}
