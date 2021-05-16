<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $perPage = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rate',
        'content',
        'user_id',
        'tour_id',
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
     * response
     *
     */
    public function getRateResponse()
    {
        return [
            'id' => $this->id,
            'rate' => $this->rate,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'tour_id' => $this->tour_id,
            'created_at' => $this->created_at,
            'user' => $this->user ?? null,
        ];
    }
}
