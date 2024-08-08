<?php

namespace App\Http\Controllers;

use App\Enums\ContactStatus;
use App\Models\Admin;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Hotel;
use App\Models\MealSystem;
use App\Models\Order;
use App\Models\OrderMonitoring;
use App\Models\Problem;
use App\Models\SolvedProblem;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;

class DashboardController extends Controller
{
    public function page()
    {
        $users = User::count('id');
        $pending_contacts = Contact::where('status', ContactStatus::PENDING->value)->count('id');
        $solved_contacts = Contact::where('status', ContactStatus::SOLVED->value)->count('id');
        $testimonials = Testimonial::count('id');
        $problems = Problem::count('id');
        $categories = Category::count('id');
        $admins = Admin::count('id');
        $bookmarks = Bookmark::distinct('problem_id')->count('id');
        $total_probelm_solved_by_users = SolvedProblem::count('id');

        $users_chart = [
            'label' => [],
            'data' => [] 
        ];
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonths($i);
            $year = $date->format('Y');
            $month = $date->format('m');
            $user_counts = User::whereYear('created_at',$year)->whereMonth('created_at',$month)->count();
            array_unshift($users_chart['label'], $date->format('F Y'));
            array_unshift($users_chart['data'], $user_counts);
        }

        $most_problem_solved_by_users =  SolvedProblem::select(
            'user_id',
            DB::raw('count(*) as total')
        )
        ->groupBy('user_id')
        ->orderBy('total','desc')
        ->limit(10)
        // ->whereDate('created_at','>', date('Y-m-d', strtotime('-7 days')))
        ->get()->map(function($item){
            $users = User::where('id', $item->user_id)->first();
            $item->name = $users->firstName." ".$users->lastName;
            $item->short_name = ucwords($users->firstName[0].$users->lastName[0]);
            return $item;
        });


        // return DB::table('solved_problems')->select(
        //     'user_id',
        //     DB::raw("CONCAT(users.firstName,' ',users.lastName) as name"),
        //     DB::raw("CONCAT(SUBSTRING(users.firstName FROM 1 FOR 1), SUBSTRING(users.lastName FROM 1 FOR 1)) AS shortName"),
        //     DB::raw('count(*) as total')
        //     )
        //     ->join('users', 'users.id', 'solved_problems.id')
        //     ->groupBy('user_id', 'users.firstName', 'users.lastName')
        //     ->orderBy('total', 'desc')
        //     ->get();
       
        return view('dashboard', compact(
            'users',
            'pending_contacts',
            'solved_contacts',
            'testimonials',
            'problems',
            'categories',
            'bookmarks',
            'admins',
            'users_chart',
            'most_problem_solved_by_users',
            'total_probelm_solved_by_users'
        ));
    }
}
