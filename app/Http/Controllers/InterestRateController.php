<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Models\InterestsRate;
use Illuminate\Support\Facades\Auth;

class InterestRateController extends Controller
{
    private $interestsrate;
    private $community;
    private $user;

    public function __construct(InterestsRate $interestsrate, Community $community, User $user)
    {
        $this->interestsrate = $interestsrate;
        $this->community         = $community;
        $this->user = $user;
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

    public function update(Request $request, $id)
    {

        #1. Validate the request
        $request->validate([
            'percentage' => 'required|integer|min:60|max:100',
        ]);

        #2. Save the interestrate to the db
        $interestsrate = $this->interestsrate->findOrFail($id);
        $interestsrate->percentage = $request->percentage;
        $interestsrate->save();

        # 3. Redirect back to the page
        return redirect()->back();
    }

    public function destroy($id)
    {
        $interestsrate = $this->interestsrate->findOrFail($id);
        $interestsrate->forceDelete();

        return redirect()->back();
    }
    
}
