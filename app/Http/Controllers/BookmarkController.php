<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\RedirectResponse;
use App\Models\Bookmark;
use App\Models\SolvedProblem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookmarkController extends Controller
{
    function BookmarkPage(Request $request){
        $user_id=$request->header('user_id');
        $JsonData=Bookmark::where('user_id','=',$user_id)->select(['problem_id','created_at'])->with('problem:id,title,title_bn,description,description_bn,difficulty,tags')->get();

        return Helper::SendReponse($JsonData, 'fetch successfully');
    }

    function AddBookmarkRequest(Request $request){
        $user_id=$request->header('user_id');
        $problem_id=$request->input('problem_id');
        $Data=Bookmark::updateOrInsert(['problem_id'=>$problem_id,'user_id'=>$user_id],['problem_id'=>$problem_id,'user_id'=>$user_id]);
        if($Data){
            return Helper::SendReponse([], 'bookmark added successfully');
        }
        else{
            return Helper::SendReponse([], 'bookmark added failed', 500);
        }
    }

    function RemoveBookmarkRequest(Request $request){
        $user_id=$request->header('user_id');
        $problem_id=$request->input('problem_id');
        $result=Bookmark::where([['user_id','=',$user_id], ['problem_id','=',$problem_id]])->delete();
        if($result==1){
            $data =['message'=>'Request Successful','status' => true];
            return Helper::SendReponse($data, 'bookmark deleted successfully');
        }
        else{
            $data =['message'=>'Request Fail ! Try Again','status' => false];
            return Helper::SendReponse($data, 'bookmark delete failed', 500);
        }
    }

}
