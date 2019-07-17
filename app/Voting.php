<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Voting extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'votings';
    protected $fillable = [
        'title', 'description','image', 'active', 'start_time', 'end_time'
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
