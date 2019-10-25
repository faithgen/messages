<?php

namespace FaithGen\Messages\Http\Requests\Message;

use FaithGen\SDK\Helpers\Helper;
use FaithGen\Messages\Models\Message;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $message = Message::findOrFail($this->request->get('message_id'));
        return $this->user()->can('message.update', $message);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'message' => 'required|string|max:1500',
            'message_id' => Helper::$idValidation
        ];
    }
}
