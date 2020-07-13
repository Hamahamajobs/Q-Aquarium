<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Answer;

class SwichPageController extends Controller
{
    public function getTop(){    

    
        return view('index.top_page');
    }
}

