<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    private $community;

    public function index(){

        return view('users.community.index');
    }
}

