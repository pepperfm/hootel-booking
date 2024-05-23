<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Enums\RoomStatusEnum;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'bookings' => auth()->user()->bookings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request, Hotel $hotel, Room $room): \Illuminate\Http\JsonResponse
    {
        $booking = new Booking($request->validated());
        $booking->user()->associate($request->user());
        $room->bookings()->save($booking);
        $room->update(['status' => RoomStatusEnum::Booked]);

        return response()->json([
            'booking' => $booking,
        ], 201);
    }

    public function cancel(Hotel $hotel, Room $room, Booking $booking): \Illuminate\Http\JsonResponse
    {
        /**
         * @see https://laravel.com/docs/11.x/eloquent#comparing-models
         */
        if ($booking->user->isNot(auth()->user())) {
            return response()->json(status: 403);
        }
        auth()->user()->bookings()->where('room_id', $room->getKey())->delete();
        $room->update(['status' => RoomStatusEnum::Available]);

        return response()->json(status: 204);
    }
}
