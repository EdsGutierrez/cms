<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;

class ApiController extends Controller
{
    //Constructor
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    // Del nuevo controlador de getSubCategories en admin.php
    public function getSubCategories($parent)
    {
        $categories = Category::where('parent', $parent)->get();
        return response()->json($categories);
    }
}
