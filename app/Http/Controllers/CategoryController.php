<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $query = Category::where('is_active', true)->orderBy('name');

    if ($request->filled('group')) {
        $query->where('group', $request->group);
    }

    $categories = $query->get();

    return view('categories.index', compact('categories'));
}

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('categories.show', compact('category'));
    }
}