<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @see https://laravel.com/docs/11.x/validation#form-request-validation
 */
class UpdateBookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
