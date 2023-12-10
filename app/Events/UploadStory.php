<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UploadStory
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $storyId;
    public $storyContent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($storyId, $storyContent)
    {
        $this->storyId = $storyId;
        $this->storyContent = $storyContent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
