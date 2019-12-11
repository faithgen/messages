<?php

namespace FaithGen\Messages\Http\Requests\Message;

use FaithGen\SDK\Helpers\Helper;
use FaithGen\Messages\MessageService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(MessageService $messageService)
    {
        return $this->user()->can('message.view', $messageService->getMessage());
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

    function failedAuthorization()
    {
        throw new AuthorizationException('You do not have access to this message');
    }
}
