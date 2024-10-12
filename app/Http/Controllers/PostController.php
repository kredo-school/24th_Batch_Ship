<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\PostComment;

class PostController extends Controller
{
    private $post;
    private $categoryPost;
    private $category;

    protected $fillable = ['description', 'image'];

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

    }

    # Go to Post for auth user
    public function authPostIndex()
    {
        $user = Auth::user();

        // categories with auth user
        $categoryUsers = $user->CategoryUser;

        // to get all categories for posts
        $relatedPosts = collect();

        foreach ($categoryUsers as $categoryUser) {
            $category = $categoryUser->category;

            if ($category) {
                // relatedPosts
                $posts = $category->relatedPosts;

                // when new posts has posted, it increases
                if ($posts->isNotEmpty()) {
                    $relatedPosts = $relatedPosts->merge($posts);
                }
            }
        }
        
        // Remove duplicate posts
        $relatedPosts = $relatedPosts->unique('id'); // assuming 'id' is the primary key for posts

        return view('auth.postIndex', compact('user', 'relatedPosts'));
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
    $post = $this->post->with(['user', 'images', 'comments.user'])->findOrFail($id);

    $imageCount = $post->images->count();
    \Log::info('Number of images: ' . $imageCount); // ログに出力

    return view('users.posts.show')->with('post', $post);
}

    // store() = save the post to DB
    public function store(Request $request)
    {
        $request->validate([

            'description'       => 'max:1500|required_if:image,null',
            'image.*'           => 'mimes:jpg,jpeg,png,gif|max:1048|required_if:description,null',
            'category'          => 'required|array|between:1,3'
        ], [
            'description.max'   => 'The description must be at least 1500 characters.',
            'category.between'  => 'You must select at least one interest',

                'description'   => 'max:1500',
                'image.*'       => 'mimes:jpg,jpeg,png,gif|max:1048|required_if:description,null',
                'category'      => 'required|array|between:1,3'

        ]);

    # Save the post
    $post = $this->post->create([
        'user_id' => Auth::user()->id,
        'description' => $request->description,
    ]);
    
    // Save multiple images
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            // Get the file contents and encode them in base64
            $fileContents = file_get_contents($file->getRealPath());
            $base64Image = base64_encode($fileContents);
    
            // Save the base64 encoded data to the database
            $post->images()->create(['image_data' => $base64Image]);
        }
    }   
    
    # Save the categories to the category_post pivot table
        $category_post = [];
        foreach ($request->category as $category_id) {
            $category_post[] = ['category_id' => $category_id];
        }

        $post->categories()->attach($request->category);

    # Go back to homepage
        return redirect()->route('users.posts.show', ['id' => $post->id]);

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
        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
                ->with('post', $post)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        # 1. VALIDATE THE DATA FROM THE FORM
        $request->validate([
            'description'   => 'max:1500|required_if:image,null',
            'image.*'       => 'mimes:jpg,jpeg,png,gif|max:1048|required_if:description,null',
            'category'      => 'required|array|between:1,3'
        ], [
            'description.max' => 'The description must be at least 1500 characters.',
            'category.between' => 'You must select at least one interest',

                'description'   => 'max:1500',
                'image.*'       => 'mimes:jpg,jpeg,png,gif|max:1048|required_if:description,null',
                'category'      => 'required|array|between:1,3'

        ]);
    
        # 2. UPDATE THE POST
        $post = $this->post->findOrFail($id); // Find the post or fail
        $post->description = $request->description; // Update the description
    
        # Handle deleted images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $key) {
                // Delete images from the database
                $post->images()->where('id', $key)->delete();
            }
        }
            
        # Process new images if uploaded
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // Check if the file was uploaded successfully
                if ($file->isValid()) {
                    // Encode the image data to base64
                    $imageData = base64_encode(file_get_contents($file->getRealPath()));
                    
                    // Save to the database
                    $post->images()->create(['image_data' => $imageData]);
                }
            }
        }
    
        $post->save(); // Save the updated post
    
        # 3. DELETE ALL RECORDS from the category_post table related to this POST
        $post->categories()->detach(); // Detach all related categories
    
        # 4. SAVE the new categories to the category_post table
        $post->categories()->attach($request->category); // Attach new categories
    
        # 5. REDIRECT to Show Post page
        return redirect()->route('users.posts.show', $id); // Redirect to the post show page
    }

    


    // delete the post
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('users.posts.index');
    }


    }
