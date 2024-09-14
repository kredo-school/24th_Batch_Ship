<?php

namespace App\Http\Controllers;

use App\Models\BoardComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoardCommentController extends Controller
{
    private $boardcomment;

    public function __construct(BoardComment $boardcomment)
    {
        $this->boardcomment = $boardcomment;
    }

    public function store(Request $request, $community_id)
    {
        $request->validate([
            'comment_body' . $community_id => 'required|max:200'
        ], [
            'comment_body' . $community_id . '.required' => 'You cannot submit an empty comment.',
            'comment_body' . $community_id . '.max' => 'The comment must not have more than 200 characters.'
        ],[
            'image'      => 'nullable|mimes:jpg,jpeg,png,gif|max:1048',
        ]);

        $this->boardcomment->body    = $request->input('comment_body' . $community_id);
        $this->boardcomment->user_id = Auth::user()->id;
        $this->boardcomment->community_id = $community_id;
        $this->boardcomment->save();

        return redirect()->back();
    }
}

