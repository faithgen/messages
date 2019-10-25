<?php

namespace FaithGen\Messages\Http\Requests\Message;

use FaithGen\SDK\Helpers\Helper;
use FaithGen\Messages\Models\Message;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $message = Message::findOrFail(request()->message_id);
        return $this->user()->can('message.view', $message);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message_id' => Helper::$idValidation
        ];
    }
}
