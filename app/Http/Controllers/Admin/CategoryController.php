<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $category = Category::latest()->get(); //get latest data
        return view('admin.backend.category.all_category', compact('category'));
    }
    public function AddCategory()
    {
        return view('admin.backend.category.add_category');
    }
    //
}