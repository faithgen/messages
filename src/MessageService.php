<?php

namespace FaithGen\Messages;

use FaithGen\Messages\Models\Message;
use InnoFlash\LaraStart\Services\CRUDServices;

class MessageService extends CRUDServices
{
    /**
     * @var Message
     */
    private $message;

    public function __construct(Message $message)
    {
        if (request()->has('message_id')) {
            $this->message = Message::findOrFail(request('message_id'));
        } else {
            $this->message = $message;
        }
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * This sets the attributes to be removed from the given set for updating or creating.
     * @return mixed
     */
    public function getUnsetFields()
    {
        return 'message_id';
    }

    /**
     * This get the model value or class of the model in the service.
     * @return mixed
     */
    public function getModel()
    {
        return $this->getMessage();
    }

    public function getParentRelationship()
    {
        return auth()->user()->messages();
    }
}
