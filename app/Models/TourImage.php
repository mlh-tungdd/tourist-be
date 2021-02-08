<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;

    protected $table = 'tour_images';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'thumbnail',
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
    public function getTourImageResponse()
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
    public function getTourImageResponseByTourId()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
