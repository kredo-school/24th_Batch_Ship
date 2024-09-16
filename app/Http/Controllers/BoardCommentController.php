<?php

namespace App\Http\Controllers;

use App\Models\BoardComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoardCommentController extends Controller
{
    private $comment;

    public function __construct(BoardComment $comment)
    {
        $this->comment = $comment;
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

        $this->comment->body    = $request->input('comment_body' . $community_id);
        $this->comment->user_id = Auth::user()->id;
        $this->comment->community_id = $community_id;
        $this->comment->image          = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->comment->save();

        return redirect()->back();
    }
}

