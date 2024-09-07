<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Community;
use App\Models\Event;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    private $user;
    private $post;
    private $community;
    private $event;

    public function __construct(User $user, Post $post, Community $community, Event $event)
    {
        $this->user = $user;
        $this->post = $post;
        $this->community = $community;
        $this->event = $event;
        
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $contentTypes = $request->input('content', []);
        // To display result for each specific category(user, post, community, event)
        if (!is_array($contentTypes)) {
            $contentTypes = explode(',', $contentTypes);
        }
        
        $result_users = [];
        $result_posts = [];
        $result_communities = [];
        $result_events = [];
        // call all names from categories table
        // $categories = Category::all(); 

        if ($keyword) {
            if (in_array('user', $contentTypes) || in_array('all', $contentTypes)) {
                $users = $this->user->latest()->where('username', 'LIKE', '%' . $keyword . '%')->limit(4)->get();
            }

            if (in_array('post', $contentTypes) || in_array('all', $contentTypes)) {
                $posts = $this->post->latest()->where('description', 'LIKE', '%' . $keyword . '%')->limit(4)->get();
            }

            if (in_array('community', $contentTypes) || in_array('all', $contentTypes)) {
                $communities = $this->community->latest()->where('title', 'LIKE', '%' . $keyword . '%')->limit(4)->get();
            }

            if (in_array('event', $contentTypes) || in_array('all', $contentTypes)) {
                $events = $this->event->latest()->where('title', 'LIKE', '%' . $keyword . '%')->limit(4)->get();
            }

            if (empty($users) && empty($posts) && empty($communities) && empty($events)) {
                $no_results_message = "No results found for '{$keyword}'.";
            }
        } else {
            $no_results_message = "Please enter a search keyword.";
        }


        return view('search')
            ->with('result_users', $result_users)
            ->with('result_posts', $result_posts)
            ->with('result_communities', $result_communities)
            ->with('result_events', $result_events)
            ->with('search', $keyword)
            ->with('no_results_message', $no_results_message ?? null);
            // ->with('categories', $categories);
    }
}





