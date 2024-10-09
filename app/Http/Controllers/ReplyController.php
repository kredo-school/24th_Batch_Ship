<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    protected $reply;
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    // コメントに関連するリプライを取得
    public function showReplies($commentId)
    {
        $postComment = PostComment::findOrFail($commentId);
        $replies = $postComment->replies; // これで関連するリプライを取得

        return view('replies.show', compact('postComment', 'replies'));
    }

    // リプライを保存するメソッド
    public function store(Request $request, $comment_id)
    {
        $request->validate([
            'reply' => 'required|string|max:500', // 内容の最大長を追加
        ]);

        // 新しいリプライを作成
        $reply = new Reply();
        $reply->post_comment_id = $comment_id;
        $reply->user_id = Auth::id();
        $reply->content = $request->reply;
        $reply->save();

        return redirect()->back();

    }

    // リプライを削除するメソッド
    public function deleteReply($id)
    {
        $this->reply->destroy($id);

        return redirect()->back();
    }
}
