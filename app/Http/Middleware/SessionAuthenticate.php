<?php
namespace App\Http\Middleware;
use App\Helper;
use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class SessionAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $email=Helper::GetCooke('email') ?? "default";
        if($email=="default"){
            return Helper::SendReponse([], 'unauthorized', 403);
        }
        else{
            $user_id = User::where('email',$email)->first()->id;
            $request->headers->set('email',$email);
            $request->headers->set('user_id',$user_id);
            return $next($request);
        }


    }
}
