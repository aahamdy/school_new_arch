<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = array('name');

    public function grades()
    {
        return $this->hasMany('Models\Grade');
    }
}
