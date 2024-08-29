<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    # index() - view the post index page
    public function index()
    {
        return view('users.posts.index');
    }

    // show() - view Show Post Page
    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('users.posts.show');
    }
}
