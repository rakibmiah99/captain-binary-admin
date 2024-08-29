<?php

namespace App\Http\Controllers;
use App\Models\SolvedProblem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SolvedController extends Controller
{
    function SolvedPage(Request $request){
        $user_id=$request->session()->get('user_id','0');
        $JsonData=SolvedProblem::where('user_id','=',$user_id)->select(['problem_id','created_at'])->with('problem:id,title,title_bn,description,description_bn,difficulty,tags')->get();
        return Inertia::render('dashboard/Solved', ['title' => 'স্লভ হয়েছে','JsonData'=>$JsonData])->withViewData(['title'=>'Solved']);
    }

    function RemoveSolvedRequest(Request $request):RedirectResponse{

        $user_id=$request->session()->get('user_id','0');
        $problem_id=$request->input('problem_id');
        $result=SolvedProblem::where([['user_id','=',$user_id], ['problem_id','=',$problem_id]])->delete();
        if($result==1){
            $data =['message'=>'Request Successful','status' => true];
            return redirect()->route('solved')->with($data);
        }
        else{
            $data =['message'=>'Request Fail ! Try Again','status' => false];
            return redirect()->route('solved')->with($data);
        }
    }
}
