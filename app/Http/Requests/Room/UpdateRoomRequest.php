<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\WithFailedApiValidation;

/**
 * @see https://laravel.com/docs/11.x/validation#form-request-validation
 */
class UpdateRoomRequest extends FormRequest
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
            'number' => ['integer'],
            'description' => ['string', 'max:65535'],
            'status' => ['string', 'max:255'],
        ];
    }
}
