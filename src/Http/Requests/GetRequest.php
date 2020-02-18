<?php

namespace FaithGen\Messages\Http\Requests;

use FaithGen\Messages\MessageService;
use FaithGen\SDK\Helpers\Helper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(MessageService $messageService)
    {
        return $messageService->getMessage() 
            && $this->user()->can('view', $messageService->getMessage());
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

    function failedAuthorization()
    {
        throw new AuthorizationException('You do not have access to this message');
    }
}
