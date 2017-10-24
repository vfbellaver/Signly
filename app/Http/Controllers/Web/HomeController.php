<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Billboard;
use App\Models\Message;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            $messages = Message::query()
                ->where('user_id',auth()->user()->id)
                ->where('visualized','=',false)
                ->get();
            return view('home',compact('messages'));
        }
        else{
            return view('home');
        }

    }
}
