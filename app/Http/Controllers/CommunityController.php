<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CommunityController extends Controller
{
    private $community;
    private $category;

    public function index(){

        return view('users.community.index');
    }

    public function __construct(Post $community, Category $category){
        $this->community = $community;
        $this->category = $category;
    }

    # To open the Create Community page
    public function create(){

        $all_categories = $this->category->all();
        return view('users.community.create')->with('all_categories',$all_categories);
    }

    #To save a community
    public function store(Request $request){

        # 1. Validate all from data
        $request->validate([
            'category'    => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image'       => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'title'       => 'required|max:50'
        ]);

        # 2. Save the community
        $this->community->description    = $request->description;
        $this->community->image          = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->community->user_id        = Auth::user()->id;
        $this->community->save();

        # 3. Save the categories to the category_post table
        foreach ($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }
        $this->post->categoryPost()->createMany($category_post);

        # 4. Go to show page. Update this later.
        return redirect()->route('community.show');
    }
}

