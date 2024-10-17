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
     * Get the message from PostComment
     */
    public function __construct(PostComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Set which channels to send a notification
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Method to save the notification to the database
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
