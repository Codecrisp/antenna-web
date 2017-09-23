<?php

namespace App\Events\Race;

use App\RaceEntry;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EntryArrived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entry;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RaceEntry $entry)
    {
        $this->entry = $entry;
    }

    public function broadcastWith()
    {
        $this->entry->load(['pigeon']);
        return [
            'entry' => [
                'id' => $this->entry->id,
                'timestamp_dec' => $this->entry->timestamp_dec,
                'humantime' => $this->entry->created_at->diffForHumans(),
                'datetime' => $this->entry->created_at->toDateTimeString(),
                'ringnumber' => $this->entry->pigeon->ringNumber
            ],
        ];
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('race.' . $this->entry->race->id);
    }
}
