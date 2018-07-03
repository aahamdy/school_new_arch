<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = array('school_id', 'year_id', 'grade_id', 'fee_id', 'value');
    

    public function year()
    {
        return $this->belongsTo('Models\Year');
    }
    public function school()
    {
        return $this->belongsTo('Models\School');
    }
    public function grade()
    {
        return $this->belongsTo('Models\Grade');
    }
    public function fee()
    {
        return $this->belongsTo('Models\Fees');
    }

}
