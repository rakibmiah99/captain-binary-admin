<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Problem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProblemController extends Controller
{
    function ProblemPage(Request $request){
        $JsonData=Category::all();
        return Inertia::render('dashboard/Problem', ['title' => 'সমস্যা','JsonData'=>$JsonData])->withViewData(['title'=>'Problem']);
    }
    function ProblemListPage(Request $request){

        $user_id=$request->session()->get('user_id','0');

        $JsonData=Problem::where('category_id','=',$request->category_id)->with(['solved'=>function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->get();

       return Inertia::render('dashboard/Problem-List', ['title' => 'Problem-List','JsonData'=>$JsonData])->withViewData(['title'=>'Problem-List']);
    }
}
