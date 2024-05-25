<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function show(): \Illuminate\Http\JsonResponse
    {
        return response()->json(request()->user());
    }

    public function update(UpdateUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->update($request->validated());

        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
