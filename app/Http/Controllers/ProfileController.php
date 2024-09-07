<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;
    private $category;

    public function __construct(User $user, Category $category){
        $this->user = $user;
        $this->category = $category;
    }

    public function index(){
        return $this->profileProcess(Auth::user()->id);
    }

    public function specificProfile($id){
        return $this->profileProcess($id);
    }

    public function profileProcess($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.index', compact('user'));
    }

    # visit to create profile page
    public function create()
    {
        $all_categories = Category::latest()->get();
        return view('users.profile.create', compact('all_categories'));
    }

    # store avatar and introduction in user table, store category_id and category_user in category_user table
    public function update(Request $request)
    {
        $request->validate([
            'category'      => 'required|array',
            'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction'  => 'required|min:1|max:1000'
        ]);

        $user     = $this->user->find(Auth::user()->id);
        $user->introduction = $request->introduction;

        if($request->avatar){
            $user->avatar      = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        # Save the categories to the category_user povit table
        foreach ($request->category as $category_id){
            $category_user[] = ['category_id' => $category_id, 'user_id' => Auth::user()->id ];
        }

        $user->categoryUser()->createMany($category_user);

        return redirect()->route('users.profile.index');
    }

    # visit to profile edit page
    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $all_categories = Category::latest()->get();

        // $all_categories = $this->category->all(); //retrieve all the categories

        # GET all the category IDs of this User. Then save it in a ARRAY
        $selected_categories = [];
        foreach($user->categoryUser as $category_user){
        $selected_categories[] = $category_user->category_id;
        }

        return view('users.profile.edit')
                ->with('user', $user)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }

    # update profile
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'category'      => 'required|array',
            'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction'  => 'min:1|max:1000',
            'username' => 'min:1|max:255'
        ]);

        $user     = $this->user->find(Auth::user()->id);
        $user->introduction = $request->introduction;
        $user->username = $request->username;

        if($request->avatar){
            $user->avatar      = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        # DELETE ALL RECORDS from the category_user table related to this profile
        $user->categoryUser()->delete();

        # SAVE the new categories to the category_user table
        foreach($request->category as $category_id){
            $category_user[]  =  ['category_id' => $category_id, 'user_id' => Auth::user()->id ];
        }
        $user->categoryUser()->createMany($category_user);

        return redirect()->route('users.profile.index');
    }
}

