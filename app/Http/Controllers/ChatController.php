<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    //
    /**
     *  Create a new controller instance.
     *
     *  @return void 
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function chat() 
    {

        return view('chat');
    }


    public function send(request $request) 
    {

        $user = Auth::user();

        //$message = request()->get('message');

        //object 
        $message = $user->messages()->create([

            'message' => request()->get('message')
        ]);


        event(new ChatEvent($message, $user));
    }


    public function messages()
    {

        return Message::with('user')->get();

    }
}
