<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\DemoPusherEvent;

class FrontEndController extends Controller
{
    public function getPusher(){
     // gọi ra trang view demo-pusher.blade.php
     return view("demo-pusher");
    }
    public function fireEvent(){
         // Truyền message lên server Pusher
         event(new DemoPusherEvent("New Messages at " . date('Y-m-d')));
         return "Message has been sent.";
    }
}