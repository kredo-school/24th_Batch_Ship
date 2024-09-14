<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityUser;
use Illuminate\Support\Facades\Auth;

class CommunityUserController extends Controller
{
    private $communityUser;

    public function __construct(CommunityUser $communityUser)
    {
        $this->communityUser = $communityUser;
    }

    public function join($community_id)
    {
        $this->communityUser->community_id = $community_id; // the joined community
        $this->communityUser->user_id  = Auth::user()->id;  // who joining the community
        $this->communityUser->save();

        return redirect()->back();
    }

    public function unjoin($community_id)
    {
        $this->communityUser->where('user_id', Auth::user()->id)
            ->where('community_id', $community_id)
            ->delete();

        return redirect()->back();
    }
}
