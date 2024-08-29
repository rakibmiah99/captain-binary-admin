<?php
namespace App\Http\Controllers;
use App\Helper;
use App\Mail\OTPMail;
use App\Models\Otp;;
use App\Models\User;
use Exception;
use http\Cookie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class UsersController extends Controller
{
    function LoginPage(){
        return Inertia::render('site/Login', ['title' => 'লগিন'])->withViewData(['title'=>'Login']);
    }
    function SignUpPage(){
        return Inertia::render('site/Sign-Up', ['title' => 'সাইন আপ'])->withViewData(['title'=>'Sign-Up']);
    }
    function ForgotPasswordPage(){
        return Inertia::render('site/Forgot-Password', ['title' => 'ফরগেট পাসওয়ার্ড'])->withViewData(['title'=>'Forgot-Password']);
    }
    function OTPVerificationPage(){
        return Inertia::render('site/OTP-Verification', ['title' => 'পিন ভেরিফিকেশন'])->withViewData(['title'=>'OTP-Verification']);
    }
    function SetPasswordPage(){
        return Inertia::render('site/Set-Password', ['title' => 'নতুন পাসওয়ার্ড'])->withViewData(['title'=>'Set-Password']);
    }

    function ProfilePage(Request $request){
        $email=$request->session()->get('email','default');
        $profile=User::where('email','=',$email)->first();

        $percentage=0;
        strlen($profile['email'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['firstName'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['lastName'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['mobile'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['photo'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['facebook'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['linkedin'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['whatsapp'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['github'])>0?$percentage+=10:$percentage+=0;
        strlen($profile['youtube'])>0?$percentage+=10:$percentage+=0;


        return Inertia::render('dashboard/Profile', ['title' => 'প্রোফাইল','profileDetails'=>$profile,'percentage'=>$percentage."%",'percentageNumber'=>$percentage])->withViewData(['title'=>'Profile']);
    }


    function LoginRequest(Request $request){
        $result= User::where($request->input())->count();
        $id=User::where($request->input())->select('id')->first();
        if($result==1){
            $email=$request->input('email');
            $cookie = Helper::SetCooke('email', $email);
            /*$request->session()->put('email',$email);
            $request->session()->put('user_id',$id['id']);*/
            $data = ['message'=>'লগিন সাকসেসফুল','status' => true];
        }
        else{
            $cookie = Helper::SetCooke('email', null);
            $data = ['message'=>'দুঃখিত! তোমাকে খুজে পাওয়া যায়নি','status' => false];
        }
        return Helper::SendReponse($data, 'loging success')->cookie($cookie);
    }


    function SignUpRequest(Request $request):RedirectResponse
    {
        try{
            $result= User::insert($request->input());
            if($result==1){
                $data = ['message'=>'ধন্যবাদ ! সাইন আপ সপন্ন হয়েছে','status' => true];
            }
            else{
                $data = ['message'=>'দুঃখিত ! আবার চেষ্টা করো','status' => false];
            }
            return redirect()->route('sign-up')->with($data);
        }
        catch (Exception $exception){
            $data = ['message'=>"এই ইমেইল এড্রেস ইতিমধ্যে ব্যবহার করা হয়েছে",'status' => false];
            return redirect()->route('sign-up')->with($data);
        }
    }

    function OTPRequest(Request $request):RedirectResponse
    {
        $UserEmail=$request->input('email');
        try {
            $result= User::where($request->input())->count();
            if($result==1){
                $OTP=rand (1000,9999);
                $details = ['code' =>$OTP];
                Mail::to($UserEmail)->send(new OTPMail($details));
                Otp::updateOrInsert(['email'=>$UserEmail],['email'=>$UserEmail,'otp'=>$OTP,'status'=>0]);
                $request->session()->put('otp_email',$UserEmail);
                $data = ['message'=>'৪ ডিজিটের ভেরিফিকেশন পিন পাঠানো হয়েছে, ইমেইল ইনবক্স অথবা স্প্যাম ফোল্ডার চেক করো','status' => true];
            }
            else{
                $data = ['message'=>'দুঃখিত! তোমাকে খুজে পাওয়া যায়নি','status' => false];
            }
            return redirect()->route('forgot-password')->with($data);
        }
        catch (Exception $exception){
            $data = ['message'=>$exception,'status' => false];
            return redirect()->route('forgot-password')->with($data);
        }
    }


    function OTPVerificationRequest(Request $request):RedirectResponse
    {

        $UserEmail=$request->session()->get('otp_email','default');
        $Otp=$request->input('otp');
        $result= Otp::where(['email'=>$UserEmail,'otp'=>$Otp,'status'=>'0'])->count();
        if($result==1){
            Otp::where(['email'=>$UserEmail,'otp'=>$Otp,'status'=>'0'])->update(['status'=>1]);
            $data =['message'=>'ভেরিফিকেশন সম্পন্ন হয়েছে','status' => true];
            return redirect()->route('otp-verification')->with($data);
        }
        else{
            $data = ['message'=>'ভুল ভেরিফিকেশন কোড','status' => false];
            return redirect()->route('otp-verification')->with($data);
        }
    }

    function SetNewPasswordRequest(Request $request):RedirectResponse{
        $UserEmail=$request->session()->get('otp_email','default');
        $password=$request->input('password');
        $result=User::where(['email'=>$UserEmail])->update(['password'=>$password]);
        if($result==1){
            $data =['message'=>'নতুন পাসওয়ার্ড সেট হয়েছে','status' => true];
            return redirect()->route('set-password')->with($data);
        }
        else{
            $data =['message'=>'দুঃখিত ! আবার চেষ্টা করো','status' => false];
            return redirect()->route('set-password')->with($data);
        }
    }


    function ProfileUpdateRequest(Request $request):RedirectResponse{
        sleep(4);
        $email=$request->session()->get('email','default');
        $result=User::where('email','=',$email)->update($request->input());
        if($result==1){
            $data =['message'=>'প্রোফাইল আপডেট হয়েছে ! ধন্যবাদ','status' => true];
            return redirect()->route('profile')->with($data);
        }
        else{
            $data =['message'=>'প্রোফাইল আপডেট হয়নি ! আবার চেষ্টা করো','status' => false];
            return redirect()->route('profile')->with($data);
        }
    }

    function LogoutRequest(Request $request):RedirectResponse{
           $request->session()->flush();
           return redirect()->route('home');
    }

}
