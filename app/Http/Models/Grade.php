<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = array('grade');
    
    public function values()
    {
        return $this->hasMany('Models\Value');
    }

    public function school()
    {
        return $this->belongsTo('Models\School');
    }
}
