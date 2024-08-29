<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Problem;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Inertia\Inertia;

class HomeController extends Controller
{
    function HomePage(Request $request){
        $user_id=$request->session()->get('user_id','0');
        $problem=Problem::count();
        $category=Category::count();
        $solver=User::count();
        $testimonial=Testimonial::all();
        $contactPending=Contact::where('status','=','pending')->count();
        $contactSolve=Contact::where('status','=','solved')->count();
        $JsonData=[
            'problem'=>$problem,
            'category'=>$category,
            'solver'=>$solver,
            'language'=>1,
            'testimonial'=>$testimonial,
            'contactPending'=>$contactPending,
            'contactSolve'=>$contactSolve,
        ];
        if($user_id==0){
            return Inertia::render('site/Index', ['title' => 'Captain Binary - প্রোগ্রামিং শেখার সেরা উপায়','JsonData'=>$JsonData])->withViewData(['title'=>'Home']);
        }
        else{
            return Inertia::render('dashboard/Home', ['title' => 'হোম','JsonData'=>$JsonData])->withViewData(['title'=>'Home']);
        }
    }

    function ContactRequest(Request $request):RedirectResponse{
            Contact::create($request->input());
            $data = ['message'=>'ধন্যবাদ ! মেসেজ গ্রহন করা হয়েছে','status' => true];
            return redirect()->route('home')->with($data);
    }

}
