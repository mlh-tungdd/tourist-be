<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $table = 'booking_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_day',
        'end_day',
        'qty',
        'price',
        'booking_id',
        'room_id',
        'hotel_id',
    ];

    /**
     * response
     *
     */
    public function getBookingDetailResponse()
    {
        return [
            'id' => $this->id,
            'start_day' => $this->start_day,
            'end_day' => $this->end_day,
            'qty' => $this->qty,
            'price' => $this->price,
            'booking_id' => $this->booking_id,
            'room_id' => $this->room_id,
            'hotel_id' => $this->hotel_id,
        ];
    }
}
