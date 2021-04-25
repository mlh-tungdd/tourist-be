<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $perPage = 10;

    /**
     * hotel relationship
     *
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, "hotel_id");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail',
        'name',
        'area',
        'space',
        'position',
        'options',
        'price',
        'qty',
        'note',
        'convenients',
        'hotel_id',
    ];

    /**
     * response
     *
     */
    public function getRoomResponse()
    {
        return [
            'id' => $this->id,
            'thumbnail' => $this->thumbnail,
            'name' => $this->name,
            'area' => $this->area,
            'space' => $this->space,
            'position' => $this->position,
            'options' => $this->options,
            'price' => $this->price,
            'qty' => $this->qty,
            'note' => $this->note,
            'convenients' => $this->convenients,
            'hotel_id' => $this->hotel_id,
            'hotel' => $this->hotel ?? null
        ];
    }
}
