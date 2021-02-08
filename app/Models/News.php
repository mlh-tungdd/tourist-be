<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'content',
        'thumbnail',
        'author',
        'source',
        'category_news_id'
    ];

    /**
     * category relationship
     *
     */
    public function categoryNews()
    {
        return $this->belongsTo(CategoryNews::class, 'category_news_id');
    }

    /**
     * response
     *
     */
    public function getNewsResponse()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'author' => $this->author,
            'source' => $this->source,
            'category_news_id' => $this->category_news_id,
            'category_name' => $this->categoryNews->title ?? null
        ];
    }
}
