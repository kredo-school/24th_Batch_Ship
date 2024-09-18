<?php

namespace App\Http\Controllers;

use App\Models\Percentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PercentageController extends Controller
{
    private $percentage;

    public function __construct(Percentage $percentage)
    {
        $this->percentage = $percentage;
    }

    public function store($post_id)
    {
        $this->percentage->user_id = Auth::user()->id;
        $this->percentage->post_id = $post_id; 
        $this->percentage->save();

        return redirect()->back();
    }

    // public function destroy($post_id)
    // {
    //     $this->percentage->where('user_id', Auth::user()->id)
    //         ->where('post_id', $post_id)
    //         ->delete();

    //         return redirect()->back();
    // }



}
