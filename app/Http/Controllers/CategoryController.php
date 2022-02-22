<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->all();
        
        $categories = Category::select([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);
        
        if ($request['withDeleted']) {
            $categories = $categories->withTrashed();    
        }

        if ($request['categoryId']) {
            $categories = $categories->where('id', $request['categoryId']);
        }

        if ($request['categoryName']) {
            $categories = $categories->where('name', 'like', '%' . $request['categoryName'] . '%');
        }

        if ($request['orderByFieldName']) {
            $categories = $categories->orderBy($request['orderByFieldName'], $request['orderByMethod']);
        }
    
        $categories = $categories->paginate(20);

        return view('admin.category.index', compact('categories'));
    }

    public function create(int $id = null)
    {
        $category = null;

        if ($id) {
            $category = Category::where('id', $id)->first();
        }

        return view('admin.category.form', compact('category'));
    }

    public function store(CategoryRequest $request)
    {   
        $this->validate($request, [
            'name' => 'required|unique:categories|max:250|min:4', 
            'description' => 'nullable|max:1000|min:4', 
            'icon' => 'nullable|max:250|min:4', 
            'image' => 'nullabe|mimes:.jpg,.jpeg,.png,.bmp'
        ]);

        $request = $request->only([
            'name', 
            'description', 
            'icon', 
            'image'
        ]);

        $category = Category::create($request);

        return redirect('category')->with('message', __('basic.category.created_with_success'));
    }

    public function show(int $categoryId)
    {
        $category = null;
        
        if ($categoryId) {
            $category =  Category::where('id', $categoryId)->first();
        }
        
        return view('admin.category.view', compact('category'));
    }

    public function update(Request $request, int $categoryId)
    {
        $this->validate($request, [
            'name' => 'required|max:250|min:4', 
            'description' => 'nullable|max:1000|min:4', 
            'icon' => 'nullable|max:250|min:4', 
            'image' => 'nullabe|mimes:.jpg,.jpeg,.png,.bmp'
        ]);

        $request = $request->only([
            'name', 
            'description', 
            'icon', 
            'image'
        ]);

        Category::where('id', $categoryId)->update($request);

        return redirect('category')->with('message', __('basic.category.created_with_success'));
    }

    public function destroy(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $categoryId = $request->post('id');
        Category::where('id', $categoryId)->delete();

        return response()->json(__('basic.category.deleted_with_success'), Response::HTTP_OK);
    }
}
