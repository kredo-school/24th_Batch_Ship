<?php
    namespace App\Http\Controllers;
    
    use App\Models\User;
    use App\Models\Post;
    use App\Models\PostComment;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Notifications\CommentNotification;
    
    class PostCommentController extends Controller
    {
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
    
                // Update the comment if it was provided
                if ($request->filled('comment')) {
                    $existingComment->comment = $request->comment;
                }
    
                $existingComment->save();
                $postComment = $existingComment; // Use existing comment for notification
            } else {
                // Save a new comment to the db
                $postComment = new PostComment();
                $postComment->comment = $request->comment;
                $postComment->percentage = $request->percentage;
                $postComment->user_id = Auth::user()->id;
                $postComment->post_id = $post_id;
                $postComment->save();
            }
    
            // Send notification to the post owner
            $postOwner = Post::find($post_id)->user; // Get the post owner
            $postOwner->notify(new CommentNotification($postComment));
    
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
            PostComment::destroy($id); // Delete comment by ID
            return redirect()->back();
        }
    }