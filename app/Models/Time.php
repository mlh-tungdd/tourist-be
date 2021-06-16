<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $table = 'times';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * response
     *
     */
    public function getTimeResponse()
    {
        return [
            'id' => $this->id,
            'ngFanclubMember' => [
                'fanclubMember' => [
                    'fanclubMemberCode' => $this->title,
                    'id' => $this->id
                ]
            ],
            'title' => $this->title,
            'updatedAt' => $this->createdAt
        ];
    }
}
