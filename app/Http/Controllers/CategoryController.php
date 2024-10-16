<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category){
        $this->category  = $category;

    }

    public function show($id)
    {
        // To get categories
        $category = Category::findOrFail($id);
    
        $users       = $category->users()->where('id', '!=', auth()->id())->paginate(4, ['*'], 'users_page');
        $posts       = $category->posts()->where('user_id', '!=', auth()->id())->paginate(4, ['*'], 'post_page');
        $communities = $category->communities()->where('owner_id', '!=', auth()->id())->paginate(4, ['*'], 'communities_page');
        $events      = $category->events()->where('host_id', '!=', auth()->id())->paginate(4, ['*'], 'events_page');
    
        return view('users.categories.show', compact('category', 'users', 'posts', 'communities', 'events'));
    }
    
        

}
