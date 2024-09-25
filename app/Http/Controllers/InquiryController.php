<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function create()
    {
        return view('users.support.create');
    }

    public function store(Request $request)
    {
        # 1. Validate the form data
        $request->validate([
            'subject'  => 'required|string|max:255',
            'message'  => 'required|string'
        ]);
    
        # 2. Save the inquiry
        $this->inquiry->user_id = Auth::user()->id;
        $this->inquiry->subject = $request->subject;
        $this->inquiry->message = $request->message;
        $this->inquiry->save();
    
        # 3. Redirect to Show Inquiry page
        return redirect()->route('inquiry.submitted', $this->inquiry->id);
    }

    public function submitted($id)
    {
        // $id - ID of the inquiry
        $inquiry = $this->inquiry->findOrFail($id);

        return view('users.support.submitted', compact('inquiry'));
    }
}
