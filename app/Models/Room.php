<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\RoomStatusEnum;

class Room extends Model
{
    protected $fillable = [
        'number',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => RoomStatusEnum::class,
    ];

    /**
     * @see https://laravel.com/docs/11.x/eloquent-mutators#defining-an-accessor
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isAvailable(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->status === RoomStatusEnum::Available,
        );
    }

    /**
     * @see https://laravel.com/docs/11.x/eloquent#local-scopes
     */
    public function scopeAvailable(Builder $builder): void
    {
        $builder->where('status', RoomStatusEnum::Available);
    }

    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
