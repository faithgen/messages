<?php

namespace FaithGen\Messages\Observers;

use FaithGen\Messages\Models\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param Message $message
     * @return void
     */
    public function created(Message $message)
    {
        //
    }

    /**
     * Handle the message "updated" event.
     *
     * @param Message $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param Message $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param Message $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param Message $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
