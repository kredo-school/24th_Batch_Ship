<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Community;
use App\Models\Event;
use App\Models\Post;
use App\Models\CommunityUser;
use App\Models\Compatibility;
use App\Models\EventUser;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Notifications\CommentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // 追加
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    private $user;
    private $post;
    private $category;
    private $community;


    public function __construct(User $user, Post $post, Category $category, Community $community, ){
        $this->user = $user;
        $this->post = $post;
        $this->category = $category;
        $this->community = $community;

        // $this->event = $event;
    }

    public function index(){
        return $this->profileProcess(Auth::user()->id);
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

                // when a new post comes, it increases
                if ($posts->isNotEmpty()) {
                    $relatedPosts = $relatedPosts->merge($posts);
                }
            }
        }

        return view('auth.postIndex', compact('user', 'relatedPosts'));
    }

    public function specificProfile($id){
        return $this->profileProcess($id);
    }


    // public function profileProcess($id)
    // {
    //     $user = $this->user->findOrFail($id);

    //     $own_communities = Community::where('owner_id', $id)->paginate(4, ["*"], 'own_communities');
    //     $join_communities = CommunityUser::where('user_id', $id)->paginate(4, ["*"], 'join_communities');
    //     $own_events = Event::where('host_id', $id)->paginate(4, ["*"], 'own_events');
    //     $join_events = EventUser::where('user_id', $id)->paginate(4, ["*"], 'join_events');
    //     $reactedCompatibilities = Compatibility::with('sender')->where('user_id', $id)->get();
    //     $reactingCompatibilities = Compatibility::with('user')->where('send_user_id', $id)->get();

    //     // ユーザーの投稿を取得
    //     $posts = Post::where('user_id', $id)->get();

    //     // これらの投稿に対するコメントを取得
    //     $comments = PostComment::whereIn('post_id', $posts->pluck('id'))->get();

    //     return view('users.profile.index', compact('user', 'own_communities', 'join_communities', 'own_events', 'join_events', 'reactedCompatibilities', 'reactingCompatibilities', 'posts', 'comments'));
    // }


    //     return view('users.profile.index', compact('user', 'own_communities', 'join_communities', 'own_events', 'join_events','reactedCompatibilities', 'reactingCompatibilities'));
    public function profileProcess($id) {
        $user = $this->user->findOrFail($id);
        
        // ユーザーの投稿をページネート
        $posts = Post::where('user_id', $id)->paginate(4);
    
        $own_communities = Community::where('owner_id', $id)
                            ->paginate(4, ['*'], 'own_communities');
    
        $join_communities = CommunityUser::where('user_id', $id)
                              ->paginate(4, ['*'], 'join_communities');
    
        $own_events = Event::where('host_id', $id)
                      ->orderByRaw('CASE WHEN date > ? THEN 0 ELSE 1 END, date desc', [now()]) // to order date newest
                      ->paginate(4, ['*'], 'own_events');
    
        $join_events = Event::whereHas('attendees', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    })->with('community')
                    ->orderByRaw('CASE WHEN date > ? THEN 0 ELSE 1 END, date desc', [now()]) // to order date newest
                    ->paginate(4, ['*'], 'join_events');
    
        $reactedCompatibilities = Compatibility::with('sender')
                                  ->where('user_id', $id)
                                  ->get();
    
        $reactingCompatibilities = Compatibility::with('user')
                                  ->where('send_user_id', $id)
                                  ->get();
    
        // これらの投稿に対するコメントを取得
        $comments = PostComment::whereIn('post_id', $posts->pluck('id'))->get();
    
        return view('users.profile.index', compact(
            'user', 'posts', 'own_communities', 'join_communities',
            'own_events', 'join_events',
            'reactedCompatibilities', 'reactingCompatibilities', 'comments'
        ));
    }
  



    public function storeCompatibility(Request $request)
    {
        Log::info('storeCompatibility called');

        // バリデーション
        $request->validate([
            'compatibility' => 'required|integer|min:60|max:100',
        ]);

        $currentUserId = Auth::id(); // ログインしているユーザーのID
        $profileOwnerId = $request->send_user_id; // プロフィールページのオーナーのID

        // 互換性が既に存在するか確認
        $compatibility = Compatibility::where('user_id', $profileOwnerId)
                                      ->where('send_user_id', $currentUserId)
                                      ->first();

        if ($compatibility) {
            // 互換性が存在する場合はアップデート
            Log::info('Updating compatibility:', [
                'user_id' => $profileOwnerId,
                'send_user_id' => $currentUserId,
                'compatibility' => $request->compatibility,
            ]);
            $compatibility->compatibility = $request->compatibility;
            $compatibility->save();
            Log::info('Updated compatibility successfully.');
        } else {
            // 互換性が存在しない場合は新規作成
            Log::info('Creating new compatibility:', [
                'user_id' => $profileOwnerId,
                'send_user_id' => $currentUserId,
                'compatibility' => $request->compatibility,
            ]);
            Compatibility::create([
                'user_id' => $profileOwnerId, // プロフィールページのオーナーのID
                'send_user_id' => $currentUserId, // 送信側のユーザーのID
                'compatibility' => $request->compatibility,
            ]);
            Log::info('Created compatibility successfully.');
        }

        return redirect()->back()->with('success', 'Compatibility saved successfully.');
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
            'category' => 'required|array',
            'avatar' => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction' => 'required|min:1|max:1000',
        ], [
            'introduction.max' => 'The introduction must not exceed 1000 characters.',
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
            'username'      => 'min:1|max:255'
        ], [
            'introduction.max' => 'The introduction must not exceed 1000 characters.',
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


    // PostComment for SpecificProfile page


    public function storeEmpathy(Request $request, $post_id)
{
    // 1. Validate the request
    $request->validate([
        'percentage' => 'required|integer|min:60|max:100',
        'comment' => 'nullable|string|max:150',
    ]);

    // 2. Find the post and its owner
    $post = Post::findOrFail($post_id);
    $ownerId = $post->user_id;

    // 3. Check for an existing comment
    $existingComment = PostComment::where('post_id', $post_id)
        ->where('user_id', Auth::id())
        ->first();

    if ($existingComment) {
        // 2回目以降の投稿: percentageのみを更新
        $existingComment->percentage = $request->percentage;
        $existingComment->save();
    } else {
        // 新しいコメントを作成
        $postComment = new PostComment();
        $postComment->comment = $request->comment; // 初回のみコメントを設定
        $postComment->percentage = $request->percentage;
        $postComment->user_id = Auth::id();
        $postComment->post_id = $post_id;
        $postComment->save();

        // 4. Send notification to the post owner
        $user = User::find($ownerId);
        if ($user) {
            $user->notify(new CommentNotification($postComment));
        }
    }

    // 5. Redirect back to the owner's profile page
    return redirect()->route('users.profile.specificProfile', ['id' => $ownerId]);
}




    # To get user's own communities
    // public function getOwnCommunity($id){
    //     $user = $this->user->findOrFail($id);
    //     $own_communities = [];
    //     $all_communities = $this->community->latest()->get();

    //     foreach ($all_communities as $community){
    //         if($user->id === $community->owner_id){
    //             $own_communities[] = $community;
    //         }
    //     }
    //     return $own_communities;
    // }

    # To get user's own events
    // public function getOwnEvents($id){
    //     $user = $this->user->findOrFail($id);
    //     $own_events = [];
    //     $all_events = $this->event->latest()->get();

    //     foreach($all_events as $event){
    //         if($user->id === $event->host_id){
    //             $own_events[] = $event;
    //         }
    //     }
    //     return $own_events;
    // }

    }


