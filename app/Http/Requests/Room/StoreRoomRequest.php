<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Traits\WithFailedApiValidation;
use App\Enums\RoomStatusEnum;

/**
 * @see https://laravel.com/docs/11.x/validation#form-request-validation
 */
class StoreRoomRequest extends FormRequest
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
            'number' => ['required', 'integer'],
            'description' => ['required', 'string', 'max:65535'],
            /**
             * @see https://laravel.com/docs/11.x/validation#rule-enum
             */
            'status' => ['required', 'string', Rule::enum(RoomStatusEnum::class)],
        ];
    }
}
