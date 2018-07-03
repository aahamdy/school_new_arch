<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = array('school_id', 'year_id', 'name');

    public function year()
    {
        return $this->belongsTo('App\Year');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function fees()
    {
        return $this->hasMany('App\Fees');
    }
    
}
