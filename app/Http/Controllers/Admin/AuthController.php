<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $admin = Admin::where($request->only(['email']))->first();
        try{
            if (!$admin){
                throw new \Exception("Admin not found");
            }
            $match = Hash::check($request->password, $admin->password);
            if (!$match){
                throw new \Exception("Wrong password");
            }

            $admin['token'] = $admin->createToken('CaptainBinaryAdmin')->plainTextToken;
            return Helper::SendReponse($admin, 'login successfully');

        }
        catch (\Exception $exception){
            return Helper::SendReponse([], 'email or password doesn\'t match try again', 404);
        }
    }

}
