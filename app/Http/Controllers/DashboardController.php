<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Hotel;
use App\Models\MealSystem;
use App\Models\Order;
use App\Models\OrderMonitoring;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;

class DashboardController extends Controller
{
    public function page()
    {
        return view('dashboard');
    }
}
