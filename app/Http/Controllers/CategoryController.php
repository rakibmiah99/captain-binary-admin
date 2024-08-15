<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $columns = array_keys(__('db.category'));
        $data = Category::filter()->paginate(Helper::PerPage())->withQueryString();
        return view('category.index', compact('data', 'columns'));
    }

    public function show($id){
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }
        $columns = array_keys(__('db.category'));

        return view('category.details', compact('category', 'columns'));
    }

    public function create(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('category.create');
    }

    public function edit($id, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }
        return view('category.edit', compact('category'));
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
            return redirect()->route('category.index')->with('success', Helper::CreatedSuccessFully());
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
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
            return redirect()->route('category.index')->with('success', Helper::UpdatedSuccessFully());
        }
        catch (\Exception $exception){
            return $exception->getMessage();
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
            return redirect()->back()->with('success', Helper::DeletedSuccessFully());
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

}
