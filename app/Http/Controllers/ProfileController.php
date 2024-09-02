<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index()
    {
        return view('users.profile.index');
    }

    public function create()
    {
        return view('users.profile.create');
    }
}

