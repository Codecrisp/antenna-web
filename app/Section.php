<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'api_url'];

    public function races()
    {
        return $this->hasMany(Race::class);
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
