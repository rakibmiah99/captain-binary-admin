<?php
namespace App\Http\Controllers\Admin;

use App\Enums\ContactStatus;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Problem;
use App\Models\SolvedProblem;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        ->limit(15)
        // ->whereDate('created_at','>', date('Y-m-d', strtotime('-7 days')))
        ->get()->map(function($item){
            $users = User::where('id', $item->user_id)->first();
            $item->name = $users->firstName." ".$users->lastName;
            $item->short_name = ucwords($users->firstName[0].$users->lastName[0]);
            return $item;
        });


        $last_7_days_problem_solved = [
            'label' => [],
            'data' => []
        ];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i);
            $day = $date->format('d');
            $month = $date->format('m');
            $year = $date->format('Y');
            $problem_count = SolvedProblem::whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at', $day)
            ->count();
            array_unshift($last_7_days_problem_solved['label'], $date->format('F d'));
            array_unshift($last_7_days_problem_solved['data'], $problem_count);
        }


        $last_12_month_problem_solved = [
            'label' => [],
            'data' => []
        ];

        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonth($i);
            $month = $date->format('m');
            $year = $date->format('Y');
            $problem_count = SolvedProblem::whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->count();
            array_unshift($last_12_month_problem_solved['label'], $date->format('F Y'));
            array_unshift($last_12_month_problem_solved['data'], $problem_count);
        }


        $last_4_weeks_problem_solved = [
            'label' => ['week4', 'week3', 'week2', 'this_week'],
            'data' => []
        ];

        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

            $problem_count = SolvedProblem::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

            $last_4_weeks_problem_solved['data'][] = $problem_count;
        }

        // return $last_4_weeks_problem_solved;



        $data = compact(
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
            'total_probelm_solved_by_users',
            'last_7_days_problem_solved',
            'last_12_month_problem_solved',
            'last_4_weeks_problem_solved',
        );

        return Helper::SendReponse($data, 'Fetch successfully');
    }
}
