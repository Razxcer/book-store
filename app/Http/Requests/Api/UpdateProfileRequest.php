<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Override;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    #[Override]
    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('email') && $this->input('email') !== null) {
            $data['email'] = mb_strtolower(trim((string) $this->input('email')));
        }
        if ($this->has('phone') && $this->input('phone') !== null) {
            $data['phone'] = preg_replace('/[^\d+]/', '', (string) $this->input('phone'));
        }

        $this->merge($data);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();

        return [
            /** @example Кирилл  */
            'first_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            /** @example Лукьянов  */
            'last_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            /** @example test@gmail.com  */
            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            /** @example +79992226767  */
            'phone' => [
                'sometimes',
                'nullable',
                'regex:/^\+?[1-9]\d{9,14}$/',
                Rule::unique('users', 'phone')->ignore($user->id),
            ],
        ];

    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $user = $this->user();

                $email = $this->has('email') ? $this->input('email') : $user->email;
                $phone = $this->has('phone') ? $this->input('phone') : $user->phone;

                if (blank($email) && blank($phone)) {
                    $validator->errors()->add(
                        'email',
                        'Хотя бы 1 контакт должен быть указан'
                    );
                    $validator->errors()->add(
                        'phone',
                        'Хотя бы 1 контакт должен быть указан'
                    );
                }
            },
        ];
    }
}
