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
        $this->message = new Message();

        if (request()->has('message_id')) {
            $this->message = Message::findOrFail(request('message_id'));
        }

        if (request()->route('message')) {
            $this->message = request()->route('message');
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
