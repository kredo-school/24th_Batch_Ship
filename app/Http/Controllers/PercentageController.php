<?php

namespace App\Http\Controllers;

use App\Models\Percentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PercentageController extends Controller
{
    private $percentage;


    public function __construct(Percentage $percentage )
    {
        $this->percentage = $percentage;
    }

    public function store($post_id,  Request $request)
    {
        request()->validate([
            'percentage' => 'required|numeric|between:60,100',
        ]);

        Percentage::create([
            'percentage' => $request->input('percentage'),
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,



        ]);
    
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
