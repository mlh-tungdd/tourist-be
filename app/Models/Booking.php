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
            'created_at' => $this->created_at,
        ];
    }
}
