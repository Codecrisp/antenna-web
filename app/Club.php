<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public $timestamps = false;
    protected $fillable = ['npo', 'name', 'address', 'zip_code', 'city', 'country', 'afdeling', 'user_id', 'section_id'];


    public function races()
    {
        if(!$this->section) return false;
        return $this->section->races;
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
