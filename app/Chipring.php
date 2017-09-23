<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chipring extends Model
{
    protected $fillable = ['number', 'supplier'];
    public $timestamps = false;

    public function pigeons()
    {
        return $this->belongsToMany(Pigeon::class);
    }
}
