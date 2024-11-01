<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Community;
use App\Models\BoardComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoardCommentController extends Controller
{
    private $boardcomment;
    private $community;
    private $user;

    public function __construct(BoardComment $boardcomment, Community $community, User $user)
    {
        $this->boardcomment = $boardcomment;
        $this->community = $community;
        $this->user = $user;
    }

    public function store(Request $request)
    {
        $request->validate([
            
            'comment_body' => 'nullable|max:200|required_without:image',
            'image'        => 'nullable|mimes:jpg,jpeg,png,gif|max:1048|required_without:comment_body',
        ], [
            'comment_body.required_without' => 'You must provide either a comment or an image.',
            'image.required_without'        => 'You must provide either a comment or an image.',
            'comment_body.max'              => 'The comment must not have more than 200 characters.',
        ]);

        $this->boardcomment->body    = $request->input('comment_body');
        $this->boardcomment->user_id = Auth::user()->id;
        $this->boardcomment->community_id = $request->input('community_id');

        if ($request->hasFile('image')) {
            $this->boardcomment->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $this->boardcomment->save();

        return redirect()->back();
    }

    // destroy() - delete the comment
    public function destroy($id)
    {
        $comment = $this->boardcomment->findOrFail($id);

        $comment->forceDelete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    // update() - edit the comment
    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|max:200'
        ], [
            'body' . $id . '.required' => 'You cannot submit an empty comment.',
            'body' . $id . '.max' => 'The comment must not have more than 200 characters.'
        ]);

        $comment = $this->boardcomment->findOrFail($id);
        // $comment->body = $request->input('body' . $id);
        $comment->body = $request->body;

        $comment->save();

        return redirect()->back()->with('success', 'Comment edited successfully.');
    }
}

