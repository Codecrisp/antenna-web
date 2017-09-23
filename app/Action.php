<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['command', 'antenna_id'];

    public function antenna()
    {
        return $this->hasMany(Antenna::class);
    }
}
