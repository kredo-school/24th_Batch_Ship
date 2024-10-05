<?php

namespace App\Http\Controllers;

use App\Models\InterestRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestRateController extends Controller
{
    private $interestrate;

    public function __construct(InterestRate $interstrate)
    {
        $this->interestrate = $interestrate;
    }

    public function store(Request $request, $community_id)
    {

        #1. Validate the request
        $request->validate([
            'percentage' => 'sometimes|integer|min:60|max:100',
        ]);


         #2. Save the interestrate to the db

         
         $this->interestrate->percentage = $request->percentage;
         $this->interestrate->user_id     = Auth::user()->id;
         $this->interestrate->community_id     = $community_id;
         $this->interestrate->save();

         # 3. Redirect back to the page
        return redirect()->route('communities.show', $community_id);
     }
}
