<?php
namespace App\Http\Controllers;
use App\Models\ProblemDetails;
use App\Models\ProblemReference;
use App\Models\SolvedProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class CodePadController extends Controller
{
    function CodePadPage(Request $request){
        $JsonData=ProblemDetails::where('problem_id','=',$request->problem_id)->with('problemReference')->select(['instructions','instructions_bn','code','problem_id'])->first();
        return Inertia::render('dashboard/Code-Pad', ['title' => 'সলুশন প্যাড','JsonData'=>$JsonData])->withViewData(['title'=>'Code Pad']);
    }


    function TestCodePadResult(Request $request){

        $problem_id=$request->input('problem_id');
        $codeString=$request->input('codeString');
        $testCase=ProblemDetails::where(['problem_id' => $problem_id])->select(['test_case'])->first();
        $TestEngineURL=env('JS_ENGINE');


        $res = Http::withoutVerifying()->post( $TestEngineURL, [
            'code' => $codeString,
            'testCases' => $testCase['test_case'],
        ]);


        if($res['status']=="success"){
            return  response()->json(
                [
                    'status' => "success",
                    'data' => [
                        'testCase'=>$res['data']['numTotalTests'],
                        'passCase'=>$res['data']['numPassedTests']
                    ]
                ]
            );
        }
        else{
            return  response()->json(
                ['status' => "fail"]
            );
        }
    }

    function SubmitCodePadResult(Request $request){
        $user_id=$request->session()->get('user_id','0');
        $problem_id=$request->input('problem_id');
        $codeString=$request->input('codeString');
        $test=ProblemDetails::where(['problem_id' => $problem_id])->select(['test_case','point'])->first();

        $TestEngineURL=env('JS_ENGINE');

        $res = Http::withoutVerifying()->post( $TestEngineURL, [
            'code' => $codeString,
            'testCases' => $test['test_case'],
        ]);

        if($res['status']=="success"){
            SolvedProblem::updateOrInsert(['problem_id'=>$problem_id,'user_id'=>$user_id],['problem_id'=>$problem_id,'user_id'=>$user_id,'point'=>$test['point']]);
            return  response()->json(
                [
                    'status' => "success",
                    'data' => [
                        'testCase'=>$res['data']['numTotalTests'],
                        'passCase'=>$res['data']['numPassedTests']
                    ]
                ]
            );
        }
        else{
            return  response()->json(
                ['status' => "fail"]
            );
        }
    }
}
