<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiriesController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function index()
    {
        $all_inquiries = $this->inquiry->withTrashed()->latest()->paginate(5);

        return view('admin.support.index', compact('all_inquiries'));
    }

}
