<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategryController extends Controller
{
    public function index()
    {
        return view('category.index',['categories' => Category::with('medicaments')->get()]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
         Category::create([
            'name' => $request->name,
        ]);
        // Logic to store the category
        return to_route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the category
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        $category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        // Logic to delete the category
        return redirect()->route('categories.index');
    }
    public function show($id)
    {
        return view('category.show', compact('id'));
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        $category->delete();
        return redirect()->route('categories.index');
    }
}
