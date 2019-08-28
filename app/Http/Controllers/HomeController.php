<?php

namespace App\Http\Controllers;

use App\Events\MessageDelivered;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function message()
    {
        $messages = Message::all();
        return view('message', compact('messages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $message = Message::create($data);
        broadcast(new MessageDelivered($message))->toOthers();
        return $message;
    }
}
