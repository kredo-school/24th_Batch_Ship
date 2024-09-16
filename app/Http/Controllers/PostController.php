<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Category;

class PostController extends Controller
{
    private $post;
    private $categoryPost;
    private $category;

    public function __construct(Post $post, CategoryPost $categoryPost, Category $category)
    {
        $this->post = $post;
        $this->categoryPost = $categoryPost;
        $this->category = $category;
    }


    //create() - view Create Post Page
    public function create()
    {
        $all_categories = Category::latest()->get();
        return view('users.posts.create', compact('all_categories'));
    }

    # index() - view the post index page
    public function index()

    {
        $all_posts = $this->getAllPosts();
        return view('users.posts.index')
            ->with('all_posts', $all_posts);
        // return view('users.posts.index');
    }

    private function getAllPosts()
    {
        $all_posts = $this->post->latest()->get();


        foreach($all_posts as $post){
            // if($post->user->isFollowed() || $post->user->id === Auth::user()->id){
            //     $all_posts[] = $post;
            // }

            }
            return $all_posts;
    }

    # show() - view Show Post Page
    public function show($id)
    {
       $post = $this->post->with('user')->findOrFail($id);

      return view('users.posts.show')->with('post', $post);
    }

    // store() = save the post to DB
    public function store(Request $request)
    {
        $request->validate([
            'description'   => 'required|min:1|max:1500',
            'image'      => 'nullable|mimes:jpg,jpeg,png,gif|max:1048',
            'category'      => 'required|array|between:1,3'
        ]);

        # Save the post
        $this->post->user_id        = Auth::user()->id;
        $this->post->description    = $request->description;
        $this->post->timestamps = $request->timestamps;


        if($request->image){
            $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $this->post->save();
        # Save the categories to the category_post povit table

        foreach ($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }

        $this->post->categoryPost()->createMany($category_post);

        # Go back to homepage
        return redirect()->route('users.posts.show', ['id' => $this->post->id]);
        // return redirect()->route('users.posts.show');
    }

    // edit() - view Edit Post page
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        #IF the Auth user is not the owner of the POST, redirect to index
        if(Auth::user()->id != $post->user->id){
            return redirect()->route('users.posts.show', ['id' => $this->post->id]);
        }

        $all_categories = $this->category->all(); //retrieve all the categories

        # GET all the category IDs of this POST. Then save it in a ARRAY
        $selected_categories = [];
        foreach($post->categoryPost as $categoryPost){
            $selected_categories[] = $categoryPost->category_id;
        }

        return view('users.posts.edit')
                ->with('post', $post)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }


    public function update(Request $request, $id)
    {
        #1. Validate the request
        $request->validate([
            'description'   => 'required|min:1|max:1500',
            'image'      => 'required|mimes:jpg,jpeg,png,gif|max:1048',
            'category'      => 'required|array|between:1,3'
        ]);

        # 2. Update the post
        $post = $this->post->findOrFail($id);
        $post->description = $request->description;

        // if there is a new image
        if($request->image){
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        # 3. Delete all the records from category_post related to this post
        $post->categoryPost()->delete();

        # 4. Save the categories to category_post table
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }
        $post->categoryPost()->createMany($category_post);

        # 5. Redirect to Show Post page (to confirm the update)
        return redirect()->route('users.posts.show', $id);
    }



    // delete the post
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('users.posts.index');
    }




    }
