<?php

namespace Modules\Cms\Listeners;

use Modules\Cms\Events\BlogViewer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogViewerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogViewer $blogViewer)
    {
        $this->updateblogviewere($blogViewer->blog);
    }

     function updateblogviewere($blogViewer)
    {
      $blogViewer->viewed = $blogViewer->viewed+1;
      $blogViewer->save();
    }
}
