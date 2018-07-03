<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = array('school_id', 'year');
    

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

}
