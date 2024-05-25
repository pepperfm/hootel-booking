<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\WithFailedApiValidation;

/**
 * @see https://laravel.com/docs/11.x/validation#form-request-validation
 */
class UpdateUserRequest extends FormRequest
{
    use WithFailedApiValidation;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email,' . $this->user()->getKey(),
            ],
        ];
    }
}
