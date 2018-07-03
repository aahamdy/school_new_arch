<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $fillable = array('type');

    public function values()
    {
        return $this->hasMany('Models\Value');
    }
    
}
