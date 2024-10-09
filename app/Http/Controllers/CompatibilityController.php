<?php

namespace App\Http\Controllers;

use App\Models\Compatibility;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompatibilityController extends Controller
{
    private $compatibility;
    private $user;

    public function __construct(Compatibility $compatibility, User $user)
    {
        $this->compatibility = $compatibility;
        $this->user = $user;
    }


    public function store(Request $request, $userId)
    {

        $request->validate([
            'compatibility' => 'required|integer|min:60|max:100',
        ]);


        Compatibility::create([
            'user_id' => $userId,
            'send_user_id' => Auth::user()->id,
            'compatibility' => $request->compatibility,
        ]);


        return redirect()->route('users.profile.specificProfile', $userId);
    }


    public function destroy($id)
{
    // 指定されたIDの互換性データを削除
    Compatibility::where('id', $id)
        ->where('send_user_id', Auth::user()->id)
        ->delete();

    return redirect()->back();
}

}


