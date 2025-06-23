<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'slug',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
