<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPrice extends Model
{
    use HasFactory;

    protected $table = 'tour_prices';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_customer',
        'original_price',
        'price',
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
    public function getTourPriceResponse()
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
    public function getTourPriceResponseByTourId()
    {
        return [
            'id' => $this->id,
            'type_customer' => $this->type_customer,
            'original_price' => $this->original_price,
            'price' => $this->price,
        ];
    }
}