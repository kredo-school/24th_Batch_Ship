<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller

{
    /**
     * Display a listing of the resource.
     */


    private $postcomment;
    private $post;
    private $user;


    public function __construct(PostComment $postcomment, User $user, Post $post)
    {
        $this->postcomment = $postcomment;
        $this->post = $post;
        $this->user = $user;
    }

    public function store(Request $request, $post_id)
    {

        #1. Validate the request
        $request->validate([
            'percentage' => 'required|integer|min:60|max:100',
            'comment' => 'required|string|max:150',
        ]);


        #2. Save the comment to the db

        $this->postcomment->comment = $request->comment;
        $this->postcomment->percentage = $request->percentage;
        $this->postcomment->user_id     = Auth::user()->id;
        $this->postcomment->post_id     = $post_id;
        $this->postcomment->save();

        # 3. Redirect back to the page
         return redirect()->back();
    }

    public function destroy($id)
    {
        $this->postcomment->destroy($id);

        return redirect()->back();
    }



}
