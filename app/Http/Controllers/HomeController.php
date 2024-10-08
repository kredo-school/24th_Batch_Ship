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

    // Validation
    $request->validate([
        'keyword' => 'nullable|string|max:255',
        'category' => 'nullable|exists:categories,id',
        'content' => 'required|array|min:1',
        'content.*' => 'in:username,post,community,event,all',
    ], [
        'keyword.max' => 'The keyword may not be greater than 255 characters.',
        'category.exists' => 'The selected category is invalid.',
        'content.required' => 'Please select (User, Post, Community, Event, All).',
        'content.*.in' => 'The selected content type is invalid.',
    ]);

    $keyword = $request->input('keyword');
    $contentTypes = $request->input('content', []);
    $selectedCategory = $request->input('category');

    // Get category name
    $selectedCategoryName = null;
    if ($selectedCategory) {
        $category = Category::find($selectedCategory);
        if ($category) {
            $selectedCategoryName = $category->name;
        }
    }

    // Initialize results
    $result_users = collect([]);
    $result_posts = collect([]);
    $result_communities = collect([]);
    $result_events = collect([]);
    $no_results_message = null;

    // Search query
    if (empty($keyword) && empty($contentTypes) && empty($selectedCategory)) {
        $no_results_message = "Please enter a search keyword.";
    } else {
        // Search processing
        if (in_array('username', $contentTypes) || in_array('all', $contentTypes)) {
            $result_users = $this->searchUsers($keyword, $selectedCategory);
        }

        if (in_array('post', $contentTypes) || in_array('all', $contentTypes)) {
            $result_posts = $this->searchPosts($keyword, $selectedCategory);
        }

        if (in_array('community', $contentTypes) || in_array('all', $contentTypes)) {
            $result_communities = $this->searchCommunities($keyword, $selectedCategory);
        }

        if (in_array('event', $contentTypes) || in_array('all', $contentTypes)) {
            $result_events = $this->searchEvents($keyword, $selectedCategory);
        }

        // Message for empty results
        if ($result_users->isEmpty() && $result_posts->isEmpty() && $result_communities->isEmpty() && $result_events->isEmpty()) {
            $no_results_message = "No results found";
        }
    }

    // View response
    return view('search')
        ->with('result_users', $result_users)
        ->with('result_posts', $result_posts)
        ->with('result_communities', $result_communities)
        ->with('result_events', $result_events)
        ->with('search', $keyword)
        ->with('no_results_message', $no_results_message ?? null)
        ->with('categories', Category::all())
        ->with('selectedCategory', $selectedCategory)
        ->with('selectedCategoryName', $selectedCategoryName)
        ->with('contentTypes', $contentTypes);
    }

    // User search processing
    private function searchUsers($keyword, $selectedCategory)
    {
        return $this->user->latest()
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('username', 'LIKE', '%' . $keyword . '%'); 
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('id', $selectedCategory);
                });
            })
            ->paginate(4);
    }
    

    // Post search processing
    private function searchPosts($keyword, $selectedCategory)
    {
        return $this->post->latest()
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('id', $selectedCategory);
                });
            })
            ->paginate(4);
    }

    // Community search processing
    private function searchCommunities($keyword, $selectedCategory)
    {
        return $this->community->latest()
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('id', $selectedCategory);
                });
            })
            ->paginate(4);
    }

    // Event search processing
    private function searchEvents($keyword, $selectedCategory)
    {
        return $this->event->orderBy('date', 'asc')
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('categories.id', $selectedCategory);
                });
            })
            ->paginate(4);
    }

}
