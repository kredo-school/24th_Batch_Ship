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
        $all_inquiries = $this->inquiry->withTrashed()
            ->orderByRaw('deleted_at IS NULL DESC') // Show non-deleted first
            ->latest() // Then order by latest created_at
            ->paginate(5);

        return view('admin.support.index', compact('all_inquiries'));
    }

    public function completed($id)
    {
        $this->inquiry->destroy($id);
        return redirect()->back();
    }

    public function pending($id)
    {
        $this->inquiry->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
