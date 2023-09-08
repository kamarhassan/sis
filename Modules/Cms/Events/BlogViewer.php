<?php

namespace Modules\Cms\Events;

use Modules\Cms\Entities\Blog;
use Illuminate\Queue\SerializesModels;

class BlogViewer
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $blog;
    public function __construct(Blog $blog)
    {
      $this->blog =$blog;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
