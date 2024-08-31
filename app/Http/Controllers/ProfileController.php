<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;
    private $category;

    public function __construct(User $user, Category $category) {
        $this->user = $user;
        $this->category = $category;
    }

    public function index()
    {
        return view('users.profile.index');
    }

    public function create()
    {
        return view('users.profile.create');
    }

    public function createCategory()
    {
        $all_categories = $this->category->all();
        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }
        $this->user->category()->createMany($category_id);

        # 4. Go back to the homepage
        return redirect()->route('index');
    }


}

