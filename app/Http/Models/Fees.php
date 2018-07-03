<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $fillable = array('grade_id', 'type');

    public function school()
    {
        return $this->belongsTo('App\Grade');
    }
    
}
