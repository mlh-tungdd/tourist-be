<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'regions',
        'city',
        'type',
        'is_departure'
    ];

    /**
     * response
     *
     */
    public function getLocationResponse()
    {
        return [
            'id' => $this->id,
            'regions' => $this->regions,
            'city' => $this->city,
            'type' => $this->type,
            'is_departure' => $this->is_departure
        ];
    }
}