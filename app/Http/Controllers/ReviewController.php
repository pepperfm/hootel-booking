<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Hotel $hotel): \Illuminate\Http\JsonResponse
    {
        $review = new Review($request->validated());
        $review->hotel()->associate($hotel);
        $review->user()->associate($request->user());
        $review->save();

        return response()->json([
            'review' => $review,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Hotel $hotel, Review $review): \Illuminate\Http\JsonResponse
    {
        $review->update($request->validated());

        return response()->json([
            'review' => $review,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel, Review $review): \Illuminate\Http\JsonResponse
    {
        if ($review->user->isNot(auth()->user())) {
            return response()->json(status: 403);
        }
        $review->delete();

        return response()->json(status: 204);
    }
}
