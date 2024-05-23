<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Traits\WithFailedApiValidation;

/**
 * @see https://laravel.com/docs/11.x/validation#form-request-validation
 */
class StoreBookingRequest extends FormRequest
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
            'start_date' => ['required', 'date', 'after:today', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @see https://laravel.com/docs/11.x/validation#performing-additional-validation
     *
     * @param Validator $validator
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            /**
             * @see https://laravel.com/api/11.x/Illuminate/Foundation/Http/FormRequest.html#method_route
             */
            if (!$this->route('room')->is_available) {
                $validator->errors()->add('room', 'Room is not available');
            }
        });
    }
}
