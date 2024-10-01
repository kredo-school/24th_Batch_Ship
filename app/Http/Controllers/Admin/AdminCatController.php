<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class AdminCatController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
        
    }

    public function index()
    {
        $all_categories = $this->category->orderBy('id','asc')->get();

        return view('admin.categories.index')
            ->with('all_categories',$all_categories);
            
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|max:50|unique:categories,name'
            ]);
            $this->category->name = ucwords(strtolower($request->name));
            $this->category->save();

            return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $request->validate([
                "edit_name" => "required|max:50|unique:categories,name,$id" 
            ]);
            $category = $this->category->findOrFail($id);
            $category->name = ucwords(strtolower($request->edit_name));
            $category->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->category->destroy($id);

        return redirect()->back();
    }
}
