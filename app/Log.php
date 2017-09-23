<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['type', 'message', 'ip', 'antenna_id'];

    public function antenna()
    {
        return $this->belongsTo(Antenna::class);
    }
}
