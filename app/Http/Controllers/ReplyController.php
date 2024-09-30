<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    private $reply;
    // コメントに関連するリプライを取得
    public function showReplies($commentId)
    {
        // コメントを取得
        $postComment = PostComment::findOrFail($commentId);

        // そのコメントに関連するリプライを取得
        $replies = $postComment->replies;
        $replies = Reply::where('post_comment_id', $commentId)->get();

        return view('replies.show', compact('postComment', 'replies'));
    }

    // リプライを保存するメソッド
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $reply = new Reply();
        $reply->content = $request->reply;
        $reply->user_id = Auth::user()->id;
        $reply->post_comment_id = $commentId; // ここでコメントIDを設定
        $reply->save();

        return redirect()->back(); // または適切なリダイレクト先
    }

    public function destroy($id)
    {
        $this->reply->destroy($id);

        return redirect()->back();
    }

}

