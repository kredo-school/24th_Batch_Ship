<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class SelectDataController extends Controller
{
    public function getData()
    {
        $items = Category::all();
        return response()->json($items);
    }
}
