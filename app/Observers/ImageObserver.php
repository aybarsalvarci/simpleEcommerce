<?php

namespace App\Observers;

use App\Models\Image;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     */
    public function created(Image $image): void
    {
        //
    }

    /**
     * Handle the Image "updated" event.
     */
    public function updated(Image $image): void
    {
        //
    }

    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {
        if(file_exists(public_path($image->path)))
        {
            unlink(public_path($image->path));
        }
    }

    /**
     * Handle the Image "restored" event.
     */
    public function restored(Image $image): void
    {
        //
    }

    /**
     * Handle the Image "force deleted" event.
     */
    public function forceDeleted(Image $image): void
    {
        //
    }
}
