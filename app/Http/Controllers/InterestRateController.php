<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InterestsRate;
use Illuminate\Support\Facades\Auth;

class InterestRateController extends Controller
{
    private $interestsrate;

    public function __construct(InterestsRate $interestsrate)
    {
        $this->interestsrate = $interestsrate;
    }

    public function store(Request $request, $community_id)
    {

        #1. Validate the request
        $request->validate([
            'percentage' => 'required|integer|min:60|max:100',
        ]);

         #2. Save the interestrate to the db
         $this->interestsrate->percentage = $request->percentage;
         $this->interestsrate->user_id     = Auth::user()->id;
         $this->interestsrate->community_id     = $community_id;
         $this->interestsrate->save();

         # 3. Redirect back to the page
        return redirect()->back();
     }
}
