<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'departure_id',
        'price_id',
        'qty',
        'price',
        'type_customer',
        'order_id',
        'tour_id',
    ];

    /**
     * response
     *
     */
    public function getOrderDetailResponse()
    {
        return [
            'id' => $this->id,
            'departure_id' => $this->departure_id,
            'price_id' => $this->price_id,
            'qty' => $this->qty,
            'price' => $this->price,
            'type_customer' => $this->type_customer,
            'order_id' => $this->order_id,
            'tour_id' => $this->tour_id,
        ];
    }
}
