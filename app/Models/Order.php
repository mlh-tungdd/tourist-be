<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total',
        'status',
        'payment_method',
        'payment_type',
        'user_id',
        'created_at',
    ];

    /**
     * user relationship
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * tour relationship
     */
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    /**
     * response
     *
     */
    public function getOrderResponse()
    {
        return [
            'id' => $this->id,
            'total' => $this->total,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'payment_type' => $this->payment_type,
            'user_id' => $this->user_id,
            'user' => $this->user ?? null,
            'order_detail' => $this->orderDetail ?? null,
            'created_at' => $this->created_at,
        ];
    }
}
