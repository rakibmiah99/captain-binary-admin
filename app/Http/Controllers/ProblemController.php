<?php

namespace App\Http\Controllers;

use App\Http\Requests\Problem\ProblemCreateRequest;
use App\Http\Requests\Problem\ProblemUpdateRequest;
use App\Models\ProblemDetail;
use App\Models\ProblemReference;
use Illuminate\Http\Request;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Problem;
use Illuminate\Support\Facades\DB;
class ProblemController extends Controller
{
    public function __construct()
    {
        $this->group_name = 'company';
    }

    public function index(Request $request){
        $columns = array_keys(__('db.problem'));
        $data = Problem::filter()->paginate(Helper::PerPage())->withQueryString();
        return view('problems.index', compact('data', 'columns'));
    }

    public function show($id){
        $problem = Problem::find($id);
        if (!$problem){
            abort(404);
        }
        $columns = array_keys(__('db.problem_in_details'));

        return view('problems.details', compact('problem', 'columns'));
    }

    public function create(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('problems.create');
    }

    public function edit($id, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $problem = Problem::find($id);
        // dd($problem->details);
        if (!$problem){
            abort(404);
        }
        return view('problems.edit', compact('problem'));
    }


    public function store(ProblemCreateRequest $request){
        DB::beginTransaction();
        try {

            //Make Problem Model Data
            $problems_data = $request->only([
                'title',
                'title_bn',
                'description',
                'description_bn',
                'difficulty',
                'point',
                'tags',
                'category_id',
            ]);
    
    
            //Insert Data In Problem Model
            $problem = Problem::create($problems_data);    

            //Merge Problem ID in Request 
            $request->merge(['problem_id' => $problem->id]);
    
            //Make Problem Details Data 
            $problem_details_data = $request->only([
                'code',
                'test_case',
                'point',
                'problem_id'
            ]);
    
            //Instruction Bangla PDF File Upload And Get Path and merge Data 
            $problem_details_data = collect($problem_details_data)->merge([
                'instructions_bn' => Helper::FileUpload(request_key: 'instructions_bn', path: 'files')
            ]);
    
    
            //If has file  in Instruction  then File Upload And Get Path and merge Data 
            if($request->file('instructions')){
                $problem_details_data->merge([
                    'instructions' => Helper::FileUpload(request_key: 'instructions', path: 'files')
                ]);
            }
    
            //Insert data in problem details model
            $problem_detail = ProblemDetail::create($problem_details_data->toArray());
            
    
        
            //If has reference title or reference link then 
            if($request->reference_title || $request->reference_link){
                //Make problem reference data 
                $problem_reference_data = $request->only([
                    'reference_title',
                    'reference_link', 
                    'problem_id',
                ]);
    
                //insert data in model 
                ProblemReference::create($problem_reference_data);
            }

    
            DB::commit();
            return redirect()->back()->with('success', Helper::CreatedSuccessFully());
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, ProblemUpdateRequest $request){
        $problem = Problem::find($id);
        if (!$problem){
            abort(404);
        }

        
        DB::beginTransaction();
        
        try {  
            //Make Problem Model Data
            $problems_data = $request->only([
                'title',
                'title_bn',
                'description',
                'description_bn',
                'difficulty',
                'point',
                'tags',
                'category_id',
            ]);


            //Update Data In Problem Model
        $problem->update($problems_data);    

            //Merge Problem ID in Request 
            $request->merge(['problem_id' => $problem->id]);

            //Make Problem Details Data 
            $problem_details_data = $request->only([
                'code',
                'test_case',
                'point',
                'problem_id'
            ]);

            //Instruction Bangla PDF File Upload And Get Path and merge Data 
            $problem_details_data = collect($problem_details_data);

            //If has file  in Instruction  then File Upload And Get Path and merge Data 
            if($request->file('instructions_bn')){
                $problem_details_data = $problem_details_data->merge([
                    'instructions_bn' => Helper::FileUpload(request_key: 'instructions_bn', path: 'files')
                ]);
                
                // dd(explode(request()->root(), $problem->details->instructions_bn));
                Helper::RemoveFile($problem->details->instructions_bn);
                
            }


            //If has file  in Instruction  then File Upload And Get Path and merge Data 
            if($request->file('instructions')){
                $problem_details_data =  $problem_details_data->merge([
                    'instructions' => Helper::FileUpload(request_key: 'instructions', path: 'files')
                ]);
                Helper::RemoveFile($problem->details->instructions);
            }

            //Insert data in problem details model
            $problem->details->update($problem_details_data->toArray()) ;
            
           
        
            //If has reference title or reference link then 
            if($request->reference_title || $request->reference_link){
                //Make problem reference data 
                $problem_reference_data = $request->only([
                    'reference_title',
                    'reference_link', 
                    'problem_id',
                ]);

                //insert data in model 
                $problem->references->update($problem_reference_data);
                // ProblemReference::create($problem_reference_data);
            }
            DB::commit();
            return redirect()->back()->with('success', Helper::UpdatedSuccessFully());
        }
        catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }


    public function delete($id){
        $problem = Problem::find($id);
        DB::beginTransaction();
        if (!$problem){
            abort(404);
        }
        try {
            $problem->delete();
            DB::commit();
            return redirect()->back()->with('success', Helper::DeletedSuccessFully());
        }
        catch (\Exception $exception){
            DB::rollBack();
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
