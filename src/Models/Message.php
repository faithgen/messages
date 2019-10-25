<?php

namespace FaithGen\Messages\Models;

use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Belongs\BelongsToMinistryTrait;
use FaithGen\SDK\Traits\Relationships\Morphs\CommentableTrait;
use FaithGen\SDK\Traits\TitleTrait;

class Message extends UuidModel
{
    use  CommentableTrait, BelongsToMinistryTrait, TitleTrait;

    //****************************************************************************//
    //***************************** MODEL ATTRIBUTES *****************************//
    //****************************************************************************//
    function getMessageAttribute($val)
    {
        return ucfirst($val);
    }

    //****************************************************************************//
    //***************************** MODEL RELATIONSHIPS *****************************//
    //****************************************************************************//

}
