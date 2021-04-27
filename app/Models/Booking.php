<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total',
        'status',
        'user_id',
        'created_at',
    ];

    /**
     * user relationship
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * tour relationship
     */
    public function bookingDetail()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }

    /**
     * response
     *
     */
    public function getBookingResponse()
    {
        return [
            'id' => $this->id,
            'total' => $this->total,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'user' => $this->user ?? null,
            'booking_details' => $this->bookingDetail ?? null,
            'created_at' => $this->created_at,
        ];
    }
}
