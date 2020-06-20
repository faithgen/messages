<?php

namespace FaithGen\Messages;

use FaithGen\Messages\Models\Message;
use InnoFlash\LaraStart\Services\CRUDServices;

class MessageService extends CRUDServices
{
    /**
     * @var Message
     */
    protected Message $message;

    public function __construct()
    {
        $this->message = app(Message::class);

        $messageId = request()->route('message') ?? request('message_id');

        if ($messageId) {
            $this->message = $this->message->resolveRouteBinding($messageId);
        }
    }

    /**
     * Retrieves an instance of message.
     *
     * @return \FaithGen\Messages\Models\Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * Makes a list of fields that you do not want to be sent
     * to the create or update methods.
     * Its mainly the fields that you do not have in the messages table.
     *
     * @return array
     */
    public function getUnsetFields(): array
    {
        return ['message_id'];
    }

    public function getParentRelationship()
    {
        return auth()->user()->messages();
    }
}
