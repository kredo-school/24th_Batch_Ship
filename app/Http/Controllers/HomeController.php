<?php

namespace App\Http\Controllers;

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

<<<<<<< HEAD
    public function search(Request $request)
    {
        return view('search');
    }

=======
>>>>>>> 18b281259328301bbfbe03ab62b631c0043efa5b
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /* public function index()
    {
        return view('home');
    }
    */
}
