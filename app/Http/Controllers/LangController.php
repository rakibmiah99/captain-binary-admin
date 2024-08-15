<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    function change($lang){
        \request()->session()->put('lang', $lang);
        return redirect()->back();
    }
    function changeTheme($name, Request $request){
        $request->session()->put('theme', $name);
        return redirect()->back();
    }
}
