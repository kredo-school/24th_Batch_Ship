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
        $keyword = $request->input('keyword');
        $contentTypes = $request->input('content', []);
        $selectedCategory = $request->input('category');
        
        $result_users = collect([]);
        $result_posts = collect([]);
        $result_communities = collect([]);
        $result_events = collect([]);
        
        $categories = Category::all();
        $no_results_message = null;
        $categoryName = null;
    
        if (!empty($selectedCategory)) {
            $category = Category::find($selectedCategory);
            if ($category) {
                $categoryName = $category->name; 
            }
        }
    
        if (empty($keyword) && empty($contentTypes) && empty($selectedCategory)) {
            $no_results_message = "Please enter a search keyword AND select at least one type (User, Post, Community, Event, or All) AND category.";
        } 
        elseif (empty($keyword) && (!empty($contentTypes) || !empty($selectedCategory))) {
            if (in_array('username', $contentTypes) || in_array('all', $contentTypes)) {
                $result_users = $this->user->latest()
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('id', $selectedCategory);
                        }
                    })
                    ->paginate(4);
            }
    
            if (in_array('post', $contentTypes) || in_array('all', $contentTypes)) {
                $result_posts = $this->post->latest()
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('id', $selectedCategory);
                        }
                    })
                    ->paginate(4);
            }
    
            if (in_array('community', $contentTypes) || in_array('all', $contentTypes)) {
                $result_communities = $this->community->latest()
                    ->where('title', 'LIKE', '%' . $keyword . '%')
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('category_id', $selectedCategory); 
                        }
                    })
                    ->paginate(4); 
            }
    
            if (in_array('event', $contentTypes) || in_array('all', $contentTypes)) {
                $result_events = $this->event->latest()
                    ->where('title', 'LIKE', '%' . $keyword . '%') 
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('category_id', $selectedCategory); 
                        }
                    })
                    ->paginate(4);
            }           
                     
            if (
                $result_users->isEmpty() &&
                $result_posts->isEmpty() &&
                $result_communities->isEmpty() &&
                $result_events->isEmpty()
            ) {
                if ($categoryName) {
                    $no_results_message = "Please select at least one type (User, Post, Community, Event, or All) for '{$categoryName}'.";
                } else {
                    $no_results_message = "No results found for this category.";
                }
            }
    
        } 
        elseif (!empty($keyword) && !empty($contentTypes)) {
            if (in_array('username', $contentTypes) || in_array('all', $contentTypes)) {
                $result_users = $this->user->latest()
                    ->where('username', 'LIKE', '%' . $keyword . '%')
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('id', $selectedCategory);
                        }
                    })
                    ->paginate(4);
            }
    
            if (in_array('post', $contentTypes) || in_array('all', $contentTypes)) {
                $result_posts = $this->post->latest()
                    ->where('description', 'LIKE', '%' . $keyword . '%')
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('id', $selectedCategory);
                        }
                    })
                    ->paginate(4);
            }
    
            if (in_array('community', $contentTypes) || in_array('all', $contentTypes)) {
                $result_communities = $this->community->latest()
                    ->where('title', 'LIKE', '%' . $keyword . '%')
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('category_id', $selectedCategory); 
                        }
                    })
                    ->paginate(4); 
            }
    
            if (in_array('event', $contentTypes) || in_array('all', $contentTypes)) {
                $result_events = $this->event->latest()
                    ->where('title', 'LIKE', '%' . $keyword . '%') 
                    ->whereHas('categories', function ($query) use ($selectedCategory) {
                        if ($selectedCategory) {
                            $query->where('categories.id', $selectedCategory); 
                        }
                    })
                    ->paginate(4);
            }
            
            
            if (
                $result_users->isEmpty() &&
                $result_posts->isEmpty() &&
                $result_communities->isEmpty() &&
                $result_events->isEmpty()
            ) {
                if ($categoryName) {
                    $no_results_message = "No results found for '{$keyword}' in category '{$categoryName}'.";
                } else {
                    $no_results_message = "No results found for '{$keyword}'.";
                }
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
            ->with('no_results_message', $no_results_message ?? null)
            ->with('categories', $categories)
            ->with('selectedCategory', $selectedCategory);
    }
       

}
