<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Problem\ProblemCreateRequest;
use App\Http\Requests\Problem\ProblemUpdateRequest;
use App\Models\ProblemDetails;
use App\Models\ProblemReference;
use Illuminate\Http\Request;
use App\Helper;
use App\Models\Problem;
use Illuminate\Support\Facades\DB;
class ProblemController extends Controller
{

    public function index(Request $request){
        $data = Problem::filter()->paginate(Helper::PerPage())->withQueryString();
        return Helper::SendReponse($data, 'Fetch Successfully');
    }

    public function show($id){
        $problem = Problem::with(['details', 'references','category'])->find($id);
        if (!$problem){
            abort(404);
        }
        return Helper::SendReponse($problem, 'Fetch Successfully');
    }

    public function store(ProblemCreateRequest $request){
        DB::beginTransaction();
        try {
            // return request()->all();

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
            $problem_detail = ProblemDetails::create($problem_details_data->toArray());



            //If has reference title or reference link then
            if($request->reference_title || $request->reference_link){
                //Make problem reference data
                $problem_reference_data = $request->only([
                    'reference_title',
                    'reference_link',
                    'problem_id',
                ]);

                // return $problem_reference_data;
                for($i = 0; $i < count($problem_reference_data['reference_title']); $i++){
                    $title = $problem_reference_data['reference_title'][$i];
                    $link = $problem_reference_data['reference_link'][$i];
                    if($title){
                        ProblemReference::create([
                            'reference_title' => $title,
                            'reference_link' => $link,
                            'problem_id' => $problem_reference_data['problem_id']
                        ]);
                    }
                }


            }
            DB::commit();
            return Helper::SendReponse($problem, 'Created Successfully');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return Helper::SendReponse([], $exception->getMessage(), 500);
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

                if(count($problem_reference_data['reference_title'])){
                    $problem_id = $problem_reference_data['problem_id'];
                    ProblemReference::where('problem_id', $problem_id)->delete();
                    // return $problem_reference_data;
                    for($i = 0; $i < count($problem_reference_data['reference_title']); $i++){
                        $title = $problem_reference_data['reference_title'][$i];
                        $link = $problem_reference_data['reference_link'][$i];
                        if($title){
                            ProblemReference::create([
                                'reference_title' => $title,
                                'reference_link' => $link,
                                'problem_id' => $problem_id
                            ]);
                        }
                    }
                }


                // ProblemReference::create($problem_reference_data);
            }
            DB::commit();
            return Helper::SendReponse($problem, 'Updated Successfully');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return Helper::SendReponse([], $exception->getMessage(), 500);
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
            return Helper::SendReponse($problem, 'Deleted Successfully');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return Helper::SendReponse([], $exception->getMessage(), 500);
        }
    }
}
