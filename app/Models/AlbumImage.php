<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    use HasFactory;

    protected $table = 'album_images';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail',
        'album_id',
    ];

    /**
     * album relationship
     *
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    /**
     * response
     *
     */
    public function getAlbumImageResponse()
    {
        return [
            'id' => $this->album->id,
            'title' => $this->album->title
        ];
    }

    /**
     * response by album_id
     *
     */
    public function getAlbumImageResponseByAlbumId()
    {
        return [
            'id' => $this->id,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
