<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CategoryCommunity;
use App\Models\Community;



class CommunityController extends Controller
{
    private $community;
    private $category;
    private $categoryCommunity;

    public function index(){

        $all_communities = $this->getAllCommunities();
        return view('users.communities.index')
            ->with('all_communities', $all_communities);
    }

    private function getAllCommunities()
    {
        $all_communities = $this->community->latest()->get();


        foreach($all_communities as $community){
            // if($community->user->isFollowed() || $community->user->id === Auth::user()->id){
            //     $all_communities[] = $community;
            // }

        }

        return $all_communities;
    }

    public function __construct(Community $community, CategoryCommunity $categoryCommunity, Category $category){
        $this->community         = $community;
        $this->category          = $category;
        $this->categoryCommunity = $categoryCommunity;
    }

    # To open the Create Community page
    public function create(){

        $all_categories = Category::latest()->get();
        return view('users.communities.create', compact('all_categories'));
        
    }

    #To save a community
    public function store(Request $request){

        # 1. Validate all from data
        $request->validate([
            'category'    => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1500',
            'image'       => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'title'       => 'required|string|max:50'
        ]);

        # 2. Save the community
        $this->community->title          = $request->title;
        $this->community->description    = $request->description;
        $this->community->image          = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->community->owner_id       = Auth::user()->id;
        
        $this->community->save();

        # 3. Save the categories to the category_community table
        foreach ($request->category as $category_id){
            $category_community[] = ['category_id' => $category_id];
        }
        $this->community->categoryCommunity()->createMany($category_community);

        # 4. Go to show page. Update this later.
        return redirect()->route('communities.show', ['id' => $this->community->id]);
    }

    # To open Show Community page
    public function show($id){

        $community = $this->community->findOrFail($id);
        return view('users.communities.show')->with('community', $community);
    }
}

