<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
// use App\Models\Category;

class PostController extends Controller
{
    private $post;
    // private $category;

    // public function __construct(Post $post, )
    // {
    //     $this->post = $post;
    // //     $this->category = $category;
    // }


    //create() - view Create Post Page
    public function create()
    {

        return view('users.posts.create');
    }

    # index() - view the post index page
    public function index()
    {
        return view('users.posts.index');
    }

    # show() - view Show Post Page
    public function show()
    {
        return view('users.posts.show');
    }

    # show() - view Show Post Page
    //public function show($id)
    //{
    //    $post = $this->post->findOrFail($id);

    //   return view('users.posts.show');
    //}



}
