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

        return view('admin.categories.index', [
            'categories' => $categories,
            'title' => 'Data Category'
        ]);
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.categories.create', [
            'title' => 'Tambah Category'
        ]);
    }

    /**
     * SIMPAN CATEGORY
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * DETAIL CATEGORY
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
            'title' => 'Detail Category'
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'title' => 'Edit Category'
        ]);
    }

    /**
     * UPDATE CATEGORY
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil diupdate');
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
