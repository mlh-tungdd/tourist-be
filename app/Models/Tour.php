<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roll_number',
        'title',
        'description',
        'content',
        'schedule',
        'term',
        'thumbnail',
        'space',
        'time_id',
        'vehicle',
        'departure_id',
        'destination_id',
    ];

    /**
     * time relationship
     *
     */
    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    /**
     * departure relationship
     *
     */
    public function departure()
    {
        return $this->belongsTo(Location::class, 'departure_id');
    }

    /**
     * destination relationship
     *
     */
    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }

    /**
     * response
     *
     */
    public function getTourResponse()
    {
        return [
            'id' => $this->id,
            'roll_number' => $this->roll_number,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'schedule' => $this->schedule,
            'term' => $this->term,
            'thumbnail' => $this->thumbnail,
            'space' => $this->space,
            'time_id' => $this->time_id,
            'vehicle' => $this->vehicle,
            'departure_id' => $this->departure_id,
            'destination_id' => $this->destination_id,
            'time_name' => $this->time->title ?? null,
            'departure_name' => $this->departure->city ?? null,
            'destination_name' => $this->destination->city ?? null,
        ];
    }
}
