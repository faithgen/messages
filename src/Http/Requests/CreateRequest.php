<?php

namespace FaithGen\Messages\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('message.create');
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
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You can`t create more than 10 messages when in free subscription mode, consider upgrading');
    }
}
