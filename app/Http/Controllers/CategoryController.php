<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * LIST CATEGORY
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * SIMPAN CATEGORY
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * UPDATE CATEGORY
     */
    public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'unique:categories,name,' . $category->id,   // ignore ID saat ini
        ],
    ]);

    $category->update($validated);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category berhasil diupdate');
}

    /**
     * DETAIL CATEGORY (opsional)
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * HAPUS CATEGORY
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil dihapus');
    }
}