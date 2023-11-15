<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category.index', [
            'heading' => 'Categories Management',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function create()
    {
        return view('admin.category.add', [
            'heading' => 'Add New Category',
            'categories' => $this->categoryService->getActives(),
        ]);
    }

    public function store(Request $request)
    {
        $res = $this->categoryService->create($request);

        if($res){
            return redirect()->route('admin.category.index');
        }

        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'heading' => 'Edit Category: '.$category->name,
            'category' => $category,
            'categories' => $this->categoryService->getActives()
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $res = $this->categoryService->update($request, $category);

        if($res){
            return redirect()->route('admin.category.index');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $res = $this->categoryService->delete($request->id);

        if($res){
            return response()->json([
                'error' => false,
                'message' => 'Delete Category Successfull'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Delete Category Failed'
        ]);
    }
}
