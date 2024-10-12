<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Models\CommunityUser;
use App\Models\InterestsRate;
use App\Models\CategoryCommunity;
use Illuminate\Support\Facades\Auth;



class CommunityController extends Controller
{
    private $community;
    private $category;
    private $categoryCommunity;
    private $interestsrate;
    private $communityUser;

    public function __construct(Community $community, CategoryCommunity $categoryCommunity, Category $category, InterestsRate $interestsrate){
        $this->community         = $community;
        $this->category          = $category;
        $this->interestsrate     = $interestsrate;
    }

    public function index(){

        $all_communities = $this->getAllCommunities();
        return view('users.communities.index')
            ->with('all_communities', $all_communities);
    }
    
    # Go to Community for auth user
    public function authCommunityIndex()
    {
        $user = Auth::user();
        
        // categories with auth user's community
        $categoryUsers = $user->communityUser;
    
        // to get all categories for posts
        $relatedCommunities = collect();
    
        foreach ($categoryUsers as $categoryUser) {
            $category = $categoryUser->category;
    
            if ($category) {
                // related Communities
                $communities = $category->relatedCommunities;
    
                // when new posts has posted, it increases
                if ($communities->isNotEmpty()) {
                    $relatedCommunities = $relatedCommunities->merge($communities);
                }
            }
        }

        // Remove duplicate posts
        $relatedCommunities = $relatedCommunities->unique('id'); // assuming 'id' is the primary key for posts
    
        return view('auth.communityIndex', compact('user', 'relatedCommunities'));
    }   

    private function getAllCommunities()
    {
        $all_communities = $this->community->with(['user','categoryCommunity'])->latest()->get();


        foreach($all_communities as $community){
            // if($community->user->isFollowed() || $community->user->id === Auth::user()->id){
            //     $all_communities[] = $community;
            // }

        }

        return $all_communities;
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
        ], [
            'description.max' => 'The description must be at least 1500 characters.',
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

        // Retrieve members and categories
        $all_members = $community->members->all();
        $all_categories = $community->categoryCommunity->all();
        $all_interestsrate = $community->interestsRate->all();
        $user_percentage = 0;
        $interests_id = 0;

        $all_interestrate_users = [];
        foreach ($all_interestsrate as $interest) {
            $all_interestrate_users[] = $interest->user_id;

            if ($interest->user_id == Auth::user()->id){
                $user_percentage = $interest->percentage;
            }
        }

        $all_interestrate_ids = [];
        foreach ($all_interestsrate as $interest) {
            $all_interestrate_ids[] = $interest->id;

            if ($interest->user_id == Auth::user()->id){
                $interests_id = $interest->id;
            } 
        }

        // Check if the user is currently joined to the community
        $isJoining = $community->isJoining();

        // Check if there are active events hosted or attended by the user 
        $isActiveEvent = $community->activeEventHost() || $community->activeEventAttendee();

        // Get  getMembersWithInterests
        $membersWithInterests = $this->getMembersWithInterests($community);

        return view('users.communities.show')
            ->with('community', $community)
            ->with('all_members', $all_members)
            ->with('all_categories', $all_categories)
            ->with('all_interestsrate', $all_interestsrate)
            ->with('isJoining', $isJoining)
            ->with('isActiveEvent', $isActiveEvent)
            ->with('all_interestrate_users', $all_interestrate_users)
            ->with('user_percentage', $user_percentage)
            ->with('interests_id', $interests_id)
            ->with('membersWithInterests', $membersWithInterests);
    }

    # To open the Edit Post page
    public function edit($id){

        $community = $this->community->findOrFail($id);
        $all_categories = $this->category->all();

        # Get all category IDs of this community. Save in an array.
        $selected_categories = [];
        foreach ($community->categoryCommunity as $category_community) {
            $selected_categories[] = $category_community->category_id;
        }

        return view('users.communities.edit')
                ->with('community', $community)
                ->with('all_categories', $all_categories)
                ->with('selected_categories',$selected_categories);
    }

    public function update(Request $request, $id){

        # 1. Validate all from data
        $request->validate([
            'category'    => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1500',
            'image'       => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'title'       => 'required|string|max:50'
        ], [
            'description.max' => 'The description must be at least 1500 characters.',
        ]);

        # 2. Update the community
        $community = $this->community->findOrFail($id);
        $community->description = $request->description;
        $community->title       = $request->title;

        // If there is anew image....
        if($request->image){
            $community->image = 'data:image/' . $request->image->extension() .
                            ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $community->save();

        # 3. Delete all records from category_community related to this community
        $community->categoryCommunity()->delete();

        # 4. Save the new categories to category_community
        foreach($request->category as $category_id){
            $category_community[] = ['category_id' => $category_id];
        }
        $community->categoryCommunity()->createMany($category_community);

        # 5. Redirect to Show Post page (to confirm the update)
        return redirect()->route('communities.show',$id);
    }


    public function getMembersWithInterests($community)
    {
        // Get members and interests from the community
        $all_members = $community->members;
        $all_interests = $community->interestsRate;

        // Create a collection associating members with their interest
        $membersWithInterests = collect();

        foreach ($all_members as $member) {
            // Find the interest-rate for this member, if the member has interest-rate of this community
            $memberInterest = $all_interests->where('user_id', $member->user_id)->first();

            // Add member and their interests (if any) to the collection
            $membersWithInterests->push([
                'member' => $member,
                'interest' => $memberInterest,
            ]);
        }

        return $membersWithInterests;
    }

    public function sort(Request $request, $id)
    {
        // Interest the community using the community ID
        $community = $this->community->findOrFail($id);

        // Get members with interests
        $membersWithInterests = $this->getMembersWithInterests($community);

        // Get the sort condition from the request
        $sort = $request->input('sort', null);

        // Define sorting functions
        $sortFunctions = [
            'interest_rate' => fn($members) => $members['interest']->percentage ?? 0,
            'created_at' => fn($members) => $members['member']->created_at ?? null
        ];

        // Apply sorting if a sort condition is specified
        if (isset($sortFunctions[$sort])) {
            $membersWithInterests = $membersWithInterests->sortByDesc($sortFunctions[$sort]);
        }

        $currentDateTime = Carbon::now();
        
        return view('users.communities.modals.members-list', compact('community', 'membersWithInterests', 'currentDateTime'));
    }

}


