<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'thumbnail',
    ];

    /**
     * response
     *
     */
    public function getBannerResponse()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
