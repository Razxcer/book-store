<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendCodeRequest extends FormRequest
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
            /**
             * Email или номер телефона пользователя в международном формате. <br/>
             *
             * Пример: <i> +79992226767, test@gmail.com </i>
             *
             * @example test@gmail.com
             */
            'contact' => [
                'required',
                'string',
                'max:255',
                Rule::anyOf([
                    ['email'],
                    ['regex:/^\+?[1-9]\d{9,14}$/'],
                ]),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $contact = trim((string) $this->input('contact'));

        if (str_contains($contact, '@')) {
            mb_strtolower($contact);
        } else {
            $contact = preg_replace('/[^\d+]/', '', $contact);
        }

        $this->merge(['contact' => $contact]);
    }
}
