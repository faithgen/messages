<?php

namespace FaithGen\Messages\Traits;

use FaithGen\Messages\Models\Message;

trait HasManyMessages
{
    /**
     * Relates many messages to a given model.
     *
     * @return mixed
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
