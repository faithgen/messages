<?php

namespace FaithGen\Messages\Http\Resources;

use FaithGen\SDK\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'date' => Helper::getDates($this->created_at),
            'comments' => [
                'count' => number_format($this->comments()->count()),
            ]
        ];
    }
}
