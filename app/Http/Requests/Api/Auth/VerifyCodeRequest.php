<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\ValidationRule;

class VerifyCodeRequest extends SendCodeRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            /**
             * 4-значный одноразовый код подтверждения из SMS или письма.
             *
             * @example 2207
             */
            'code' => ['required', 'string', 'size:4'],
        ];
    }
}
