<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'company',
        'content',
        'favicon',
        'website',
        'logo',
        'address',
        'hotline',
        'email',
        'facebook',
        'youtube',
        'google',
        'instagram',
    ];

    /**
     * response
     *
     */
    public function getSettingResponse()
    {
        return [
            'title' => $this->title,
            'company' => $this->company,
            'content' => $this->content,
            'favicon' => $this->favicon,
            'website' => $this->website,
            'logo' => $this->logo,
            'address' => $this->address,
            'hotline' => $this->hotline,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'youtube' => $this->youtube,
            'google' => $this->google,
            'instagram' => $this->instagram,
        ];
    }
}
