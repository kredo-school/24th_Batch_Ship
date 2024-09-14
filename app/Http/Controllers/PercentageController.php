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
        $this->percentage->user_id = Auth::user()->id; // who liked the post
        $this->percentage->post_id = $post_id;  // the liked post
        $this->percentage->save();

        return redirect()->back();
    }

    public function destroy($post_id)
    {
        $this->percentage->where('user_id', Auth::user()->id)
            ->where('post_id', $post_id)
            ->delete();

            return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Percentage $percentage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Percentage $percentage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Percentage $percentage)
    {
        //
    }



}
