<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentNotification;


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
        // 1. Validate the request
        $request->validate([
            'percentage' => 'required|integer|min:60|max:100',
            'comment' => 'nullable|string|max:150',
        ]);

        // 2. Check if a comment by the same user already exists for this post
        $existingComment = PostComment::where('post_id', $post_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingComment) {
            // Update the existing comment's percentage
            $existingComment->percentage = $request->percentage;

            // コメントが新たに提供された場合のみ更新
            if ($request->filled('comment')) {
                $existingComment->comment = $request->comment;
            }

            $existingComment->save();
        } else {
            // Save a new comment to the db
            $postComment = new PostComment(); // new instance
            $postComment->comment = $request->comment;
            $postComment->percentage = $request->percentage;
            $postComment->user_id = Auth::user()->id;
            $postComment->post_id = $post_id;
            $postComment->save();
        }

        // Send notification when a comment is saved or updated
        $user = User::find(1); // who gets the notification
        $user->notify(new CommentNotification($existingComment ?? $postComment));

        // 3. Redirect back to the page
        return redirect()->route('users.posts.show', $post_id);
    }




     public function show($post_id)
{
    $sort = request('sort');

    $post = Post::with('user')->findOrFail($post_id);

    if ($sort === 'percentage') {
        $comments = $post->comments()->orderBy('percentage', 'desc')->get();
    } elseif ($sort === 'date') {
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
    } else {
        $comments = $post->comments; // default sorting
    }

    return view('users.posts.show', compact('comments', 'post', 'post_id'));

  }

    public function destroy($id)
    {
        $this->postcomment->destroy($id);

        return redirect()->back();
    }



}
