<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return  view('admin.auth.login');
    }
    public function dashboard()
    {
        return  view('admin.dashboard');
    }

    public function contacts()
    {
        return  view('admin.contacts');
    }

    public function testimonials()
    {
        return  view('admin.testimonial.index');
    }
    public function category()
    {
        return  view('admin.category.index');
    }
    public function users()
    {
        return  view('admin.users.index');
    }
    public function problems()
    {
        return  view('admin.problems.index');
    }
}
