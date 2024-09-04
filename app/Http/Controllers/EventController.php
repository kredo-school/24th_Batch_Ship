<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function create()
    {
        return view('users.events.create');
    }

    public function show()
    {
        return view('users.events.show');
    }

    public function edit()
    {
        return view('users.events.edit');
    }
}
