<?php

namespace App\Http\Controllers;

use App\Models\SolvedProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LeaderBoardController extends Controller
{

    function leaderBoard(Request $request){
        $user_id=$request->session()->get('user_id','0');

        $list = SolvedProblem::select('user_id', DB::raw('SUM(problems.point) as total_points'))
            ->join('problems', 'solved_problems.problem_id', '=', 'problems.id')
            ->with(['user:id,firstName,lastName,linkedin'])
            ->groupBy('user_id')
            ->orderBy('total_points', 'desc')
            ->take(50)
            ->get();

        if($user_id==0){
            return Inertia::render('site/Leader-Board', ['title' => 'লিডার বোর্ড','JsonData'=>$list])->withViewData(['title'=>'লিডার বোর্ড']);        }
        else{
            return Inertia::render('dashboard/Leader-Board', ['title' => 'লিডার বোর্ড','JsonData'=>$list])->withViewData(['title'=>'লিডার বোর্ড']);
        }

    }


}
