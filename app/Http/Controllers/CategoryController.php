<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Country;
use App\Models\MealPrice;
use App\Models\Order;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->group_name = 'company';
    }

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
            return redirect()->back()->with('success', Helper::CreatedSuccessFully());
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
            return redirect()->back()->with('success', Helper::UpdatedSuccessFully());
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

    public function changeStatus($id){
        $company =  Company::find($id);
        if (!$company){
            abort(404);
        }

        $company->status = !$company->status;
        $company->save();
        return redirect()->back()->with('success', Helper::StatusChangedSuccessFully());
    }


    //for export to pdf and Excel file
    public function export(Request $request){
        if ($request->get('export-type') == "excel"){
            return Excel::download(new \App\Exports\PDF\CompanyExport(), Helper::GenerateFileName('company', ExportFormat::XLSX->value));
        }
        else if($request->get('export-type') == "pdf"){
            return Excel::download(new \App\Exports\PDF\CompanyExport(), Helper::GenerateFileName('company', ExportFormat::PDF->value), \Maatwebsite\Excel\Excel::DOMPDF);
        }
    }
}
