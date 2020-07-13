<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    //
    public function getHarumakiInfo(){



        return view('index.harumakiInfo');
    }



    
    public function contactHarumaki(){



        return view('index.contactHarumaki');
    }
}
