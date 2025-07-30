<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

// App/Events/ReverbEvent.php

// ... (imports e use traits) ...

class ReverbEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('have-any-comment.' . $this->comment->post_id)
        ];
    }

    // REMOVA OU COMENTE ESTA FUNÇÃO:
    // public function broadcastAs()
    // {
    //     return 'ReverbEvent';
    // }

    public function broadcastWith(): array
    {
        return ['comment' => $this->comment->load('user')->toArray()];
    }
}