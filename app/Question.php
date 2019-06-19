<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Question extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'questions';

    public function voting()
    {
        return $this->belongsTo('Voting');
    }
    public function options()
    {
        return $this->hasMany('Option');
    }
}
