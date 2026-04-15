<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Categories::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Categories $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Categories $category)
    {
        if ($category->reports()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with associated reports.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}

