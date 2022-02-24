<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->all();

        $subCategories = SubCategory::select([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);

        if ($request['withDeleted']) {
            $subCategories = $subCategories->withTrashed();
        }

        if ($request['SubCategoryId']) {
            $subCategories = $subCategories->where('id', $request['categoryId']);
        }

        if ($request['SubCategoryName']) {
            $subCategories = $subCategories->where('name', 'like', '%' . $request['categoryName'] . '%');
        }

        if ($request['orderByFieldName']) {
            $subCategories = $subCategories->orderBy($request['orderByFieldName'], $request['orderByMethod']);
        }

        $subCategories = $subCategories->paginate(20);

        return view('admin.subcategory.index', compact('subCategories'));
    }

    public function create(int $id = null)
    {
        $subcategory = null;

        if ($id) {
            $subcategory = Category::where('id', $id)->first();
        }

        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.subcategory.form', compact('subcategory', 'categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->validate($request, [
            'category_id' => 'required|int|min:1',
            'name' => 'required|unique:subcategories|max:250|min:4',
            'description' => 'nullable|max:1000|min:4',
            'icon' => 'nullable|max:250|min:4',
            'image' => 'nullabe|mimes:.jpg,.jpeg,.png,.bmp'
        ]);

        $request = $request->only([
            'category_id',
            'name',
            'description',
            'icon',
            'image'
        ]);

        $subcategory = SubCategory::create($request);

        return redirect('subcategory')->with('message', __('subcategory.messages.created_with_success'));
    }

    public function show(int $subCategoryId)
    {
        $subCategory = null;

        if ($subCategoryId) {
            $subcategory =  SubCategory::where('id', $subCategoryId)->first();
        }

        return view('admin.subcategory.view', compact('subcategory'));
    }

    public function update(Request $request, int $subCategoryId)
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

        SubCategory::where('id', $subCategoryId)->update($request);

        return redirect('subcategory')->with('message', __('basic.subcategory.created_with_success'));
    }

    public function destroy(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $subCategoryId = $request->post('id');
        SubCategory::where('id', $subCategoryId)->delete();

        return response()->json(__('basic.subcategory.deleted_with_success'), Response::HTTP_OK);
    }
}
