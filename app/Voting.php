<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Voting extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'votings';

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
