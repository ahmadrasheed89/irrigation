<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class TaskUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Task $task;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task)
    {
        // fresh relations for consumers
        $this->task = $task->load('assignee', 'department', 'tags');
    }

    /**
     * The channel the event should broadcast on.
     *
     * Use a public channel for a simple setup, or private channel later.
     */
    public function broadcastOn()
    {
        return new Channel('tasks-channel');
    }

    public function broadcastWith()
    {
        return [
            'task' => [
                'id' => $this->task->id,
                'title' => $this->task->title,
                'status' => $this->task->status,
                'assigned_to' => $this->task->assigned_to,
                'assignee' => $this->task->assignee?->only('id','name'),
                'department' => $this->task->department?->only('id','name'),
            ],
        ];
    }
}
