<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Problem;
use App\Models\SolvedProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PerformanceController extends Controller
{
    function PerformancePage(Request $request){

        $user_id=$request->session()->get('user_id','0');
        $Solved=SolvedProblem::where('user_id',$user_id)->count();
        $Problem=Problem::count();
        $Bookmarked=Bookmark::where('user_id',$user_id)->count();
        $Point=SolvedProblem::where('user_id',$user_id)->sum('point');

        $Activity=SolvedProblem::where('user_id',$user_id)
            ->select(
                DB::raw("DATE_FORMAT(updated_at,'%M %Y %d') as dateKey"),
                DB::raw('sum(point) as total'))
            ->groupBy('dateKey')
            ->orderBy('updated_at','desc')
            ->limit(30)
            ->get();

        $JsonData=[
            'Activity'=>$Activity,
            'Problem'=>$Problem,
            'Solved'=>$Solved,
            'Left'=>$Problem-$Solved,
            'Bookmarked'=>$Bookmarked,
            'Point'=>$Point,
            'Level'=>round($Point/10),
        ];

       return Inertia::render('dashboard/Performance', ['title' => 'স্কোর','JsonData'=>$JsonData])->withViewData(['title'=>'Performance']);
    }
}
