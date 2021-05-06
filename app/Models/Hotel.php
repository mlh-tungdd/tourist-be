<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $perPage = 10;

    /**
     * location relationship
     *
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'description',
        'content',
        'star',
        'active',
        'thumbnail',
        'from_price',
        'location_id',
        'active',
    ];

    /**
     * response
     *
     */
    public function getHotelResponse()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'content' => $this->content,
            'star' => $this->star,
            'active' => $this->active,
            'thumbnail' => $this->thumbnail,
            'from_price' => $this->from_price,
            'location_id' => $this->location_id,
            'location_name' => $this->location->city ?? null,
            'active' => $this->active,
        ];
    }
}
