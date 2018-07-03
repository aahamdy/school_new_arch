<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = array('name');
    
    public function values()
    {
        return $this->hasMany('Models\Value');
    }
}
