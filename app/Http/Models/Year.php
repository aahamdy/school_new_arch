<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = array('year');

    public function values()
    {
        return $this->hasMany('Models\Value');
    }
    
}
