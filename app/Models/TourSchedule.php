<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourSchedule extends Model
{
    use HasFactory;

    protected $table = 'tour_schedules';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'title',
        'day_number',
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
    public function getTourScheduleResponse()
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
    public function getTourScheduleResponseByTourId()
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'title' => $this->title,
            'day_number' => $this->day_number,
        ];
    }
}