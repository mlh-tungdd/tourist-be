<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDeparture extends Model
{
    use HasFactory;

    protected $table = 'tour_departures';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_day',
        'start_time',
        'tour_id',
    ];

    /**
     * tour relationship
     *
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    /**
     * response
     *
     */
    public function getTourDepartureResponse()
    {
        return [
            'id' => $this->tour->id,
            'title' => $this->tour->title
        ];
    }

    /**
     * response by tour_id
     *
     */
    public function getTourDepartureResponseByTourId()
    {
        return [
            'id' => $this->id,
            'start_day' => $this->start_day,
            'start_time' => $this->start_time,
        ];
    }
}