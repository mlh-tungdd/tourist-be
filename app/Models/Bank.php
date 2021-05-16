<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'banks';

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail',
        'name',
        'address',
        'number_account',
        'name_account',
    ];

    /**
     * response
     *
     */
    public function getBankResponse()
    {
        return [
            'id' => $this->id,
            'thumbnail' => $this->thumbnail,
            'name' => $this->name,
            'address' => $this->address,
            'number_account' => $this->number_account,
            'name_account' => $this->name_account,
        ];
    }
}
