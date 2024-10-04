<?php

namespace App\Notifications;

use App\Models\PostComment; 
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * to get the message from PostComment
     */
    public function __construct(PostComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * set a which channel to send a notification
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * method to save the notification to database
     */
    public function toArray($notifiable)
    {
        return [
            'comment' => $this->comment->comment, 
            'user_id' => $this->comment->user_id,
            'post_id' => $this->comment->post_id,
        ];
    }
}
