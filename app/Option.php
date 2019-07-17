<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Option extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'options';
    protected $fillable = [
        'title','content', 'image', 'gallery', 'votes', 'active'
    ];
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
