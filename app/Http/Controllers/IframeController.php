<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Option;

class IframeController extends Controller
{

    public function voting($id)
    {
        
        return view('question.index');
    }

    
}
