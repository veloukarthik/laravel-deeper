<?php

namespace App\Observers;

use App\Models\Posts;
use Illuminate\Support\Facades\Log;
class PostObserver
{
    /**
     * Handle the Posts "created" event.
     */
    public function created(Posts $post): void
    {
        //
        Log::info("A Posts was created: " . $post->title);
    }

    /**
     * Handle the Posts "updated" event.
     */
    public function updated(Posts $post): void
    {
        //
        Log::info("A Posts was updated: " . $post->title);
    }
    

    /**
     * Handle the Posts "deleted" event.
     */
    public function deleted(Posts $post): void
    {
        //
        Log::info("A Posts was deleted: " . $post->title);
    }

    /**
     * Handle the Posts "restored" event.
     */
    public function restored(Posts $post): void
    {
        //
    }

    /**
     * Handle the Posts "force deleted" event.
     */
    public function forceDeleted(Posts $post): void
    {
        //
    }
}
