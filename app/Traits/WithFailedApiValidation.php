<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

trait WithFailedApiValidation
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'message' => 'Invalid request',
            'errors' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
