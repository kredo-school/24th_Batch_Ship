<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
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

    public function create()
    {
        $all_categories = Category::latest()->get();
        return view('users.profile.create', compact('all_categories'));
    }
    
    // store the user information - add avatar, introduction, category
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'category'      => 'required|array',
    //         'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1048',
    //         'introduction'  => 'required|min:1|max:1000'
    //     ]);

    //     $this->user->user_id        = Auth::user()->id; //$this->user->findOrFail(Auth::user()->id);
    //     $this->user->image          = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
    //     $this->user->introduction   = $request->introduction;
    //     $this->user->save();

    //     # Save the categories to the category_user povit table
    //     foreach ($request->category as $category_id){
    //         $category_user[] = ['category_id' => $category_id];

    //     }

    //     $this->user->categoryUser()->createMany($category_user);

    //     return redirect()->route('users.profile.index');
    // }

    public function update(Request $request)
    {
        $request->validate([
            'category'      => 'required|array',
            'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction'  => 'required|min:1|max:1000'
        ]);

        # 
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
}

