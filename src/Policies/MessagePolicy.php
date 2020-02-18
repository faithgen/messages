<?php

namespace FaithGen\Messages\Policies;

use Carbon\Carbon;
use FaithGen\Messages\Models\Message;
use FaithGen\SDK\Helpers\Helper;
use FaithGen\SDK\Models\Ministry;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the message.
     *
     * @param Ministry $user
     * @param Message $message
     * @return mixed
     */
    public static function view(Ministry $user, Message $message)
    {
        return $user->id === $message->ministry_id;
    }

    /**
     * Determine whether the user can create messages.
     *
     * @param Ministry $user
     * @return mixed
     */
    public function create(Ministry $user)
    {
        if ($user->account->level !== 'Free')
            return true;
        else {
            $messagesCount = Message::where('ministry_id', $user->id)->whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()->lastOfMonth()])->count();
            if ($messagesCount >= Helper::$freeMessagesCount)
                return false;
            else
                return true;
        }
    }

    /**
     * Determine whether the user can update the message.
     *
     * @param Ministry $user
     * @param Message $message
     * @return mixed
     */
    public function update(Ministry $user, Message $message)
    {
        return $user->id === $message->ministry_id;
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param Ministry $user
     * @param Message $message
     * @return mixed
     */
    public function delete(Ministry $user, Message $message)
    {
        return $user->id === $message->ministry_id;
    }
}
