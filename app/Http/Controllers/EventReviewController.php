<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReview;
use Illuminate\Support\Facades\Auth;

class EventReviewController extends Controller
{
    private $eventReview;

    public function __construct(EventReview $eventReview)
    {
        $this->eventReview = $eventReview;
    }

    public function store(Request $request, $event_id)
    {
        # 1. Validate the form data
        $request->validate([
            'review_rate'    => 'required|integer|min:60|max:100',
            'review_comment' => 'nullable|string|max:255'
        ], [
            'review_comment.max' => 'The comment must not exceed 255 characters.',
        ]);

        # 2. Check if the user has already reviewed this event
        $existingReview = $this->eventReview->withTrashed()
                                            ->where('event_id', $event_id)
                                            ->where('user_id', Auth::user()->id)
                                            ->first();                          
        // User can only review once per event
        if ($existingReview && !$existingReview->deleted_at) {
            return redirect()->back()->withErrors(['review_rate' => 'You have already reviewed this event.']);
        }
    
        # 3. Store or restore the review
        if ($existingReview && $existingReview->deleted_at) {
            // Restore soft-deleted review
            $existingReview->review_rate    = $request->review_rate;
            $existingReview->review_comment = $request->review_comment;
            $existingReview->deleted_at     = null; // Change deleted_at column to null to restore the review
            $existingReview->save();
        } else {
            // Store new review
            $this->eventReview->event_id       = $event_id;
            $this->eventReview->user_id        = Auth::user()->id;
            $this->eventReview->review_rate    = $request->review_rate;
            $this->eventReview->review_comment = $request->review_comment;
            $this->eventReview->save();
        }
    
        # 4. Redirect to Show Event page
        return redirect()->route('event.show', $event_id);
    }

    public function destroy($review_id)
    {
        $this->eventReview->destroy($review_id);
        return redirect()->back();
    }
}


