<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventReview extends Model
{
    use HasFactory, SoftDeletes;

    //  To tell the laravel that we are accessing the event_reviews table
    protected $table = 'event_reviews';

    protected $fillable = ['event_id', 'user_id', 'review_rate', 'review_comment'];
}
