<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function index()
    {
        return view('users.profile.index');
    }

    public function create()
    {
        return view('users.profile.create');
    }

    // store the user information - add avatar, introduction, category
    public function store(Request $request)
    {
        $request->validate([
            'category'      => 'required|array',
            'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction'  => 'required|min:1|max:1000'
        ]);

        $this->user                 = Auth::user()->id; //$this->user->findOrFail(Auth::user()->id);
        $this->user->image          = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->user->introduction   = $request->introduction;
        $this->user->save();

        # Save the categories to the category_user povit table
        foreach ($request->category as $category_id){
            $category_user[] = ['category_id' => $category_id];

        }

        $this->user->categoryUser()->createMany($category_user);


        return redirect()->route('profile.show', Auth::user()->id);
    }
}

