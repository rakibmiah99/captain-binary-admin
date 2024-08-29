<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $data = Category::filter()->paginate(Helper::PerPage())->withQueryString();
        return Helper::SendReponse($data, 'fetch successfully');
    }

    public function allCategory(){
        $data = Category::get(['id', 'categoryName', 'categoryName_bn']);
        return Helper::SendReponse($data, 'fetch successfully');
    }

    public function show($id){
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }
        return Helper::SendReponse($category, 'fetch successfully');
    }


    public function store(CategoryCreateRequest $request){
        $data = collect($request->validated())
        ->merge([
            'itemTotal' => 0,
            'categoryImg' => Helper::FileUpload(request_key: 'image', path: 'images')
        ])
        ->except('image')
        ->toArray();

        try {
            $category = Category::create($data);
            return Helper::SendReponse($category, 'created successfully');

        }
        catch (\Exception $exception){
            return Helper::SendReponse($exception->getMessage(), 'error', 500);
        }
    }


    public function update($id, CategoryUpdateRequest $request){
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }

        $data = collect($request->validated())->except('image');
        if($path = Helper::FileUpload(request_key: 'image', path: 'images')){
            $data = $data->merge([
                'categoryImg' => $path
            ]);
            Helper::RemoveFile($category->categoryImg);
        }

        try {
            $category->update($data->toArray());
            return Helper::SendReponse($category, 'updated successfully');
        }
        catch (\Exception $exception){
            return Helper::SendReponse($exception->getMessage(), 'error', 500);
        }

    }


    public function delete($id){
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }
        try {
            $category->delete();
            Helper::RemoveFile($category->categoryImg);
            return Helper::SendReponse($category, 'deleted successfully');
        }
        catch (\Exception $exception){
            return Helper::SendReponse($exception->getMessage(), 'error', 500);
        }
    }

}
