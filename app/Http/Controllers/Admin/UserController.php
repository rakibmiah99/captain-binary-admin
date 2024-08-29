<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\UserTypeEnum;
use App\Helper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profilePage(){
        $data =  Helper::AdminGuard()->user();
        return Helper::SendReponse($data, 'fetch successfully');
    }

    public function updateProfile(UpdateProfileRequest $request){
        $user = Helper::AdminGuard()->user();
        $data = collect($request->validated())->except('file')->toArray();
        $user->update($data);
        return Helper::SendReponse($user, 'update successfully');
    }

    public function changePassword(ChangePasswordRequest $request){
        if (Hash::check($request->old_password, auth()->user()->password)){
            $new_password = Hash::make($request->new_password);
            Helper::AdminGuard()->user()->update(['password' => $new_password]);
            return Helper::SendReponse([], 'update successfully');
        }
        else{
            return Helper::SendReponse([], 'password not matched', 400);
        }
    }

    public function index(Request $request){
        $data = Admin::filter()->paginate(Helper::PerPage())->withQueryString();
        return Helper::SendReponse($data, 'fetch successfully');
    }

    public function show($id){
        $user =  Admin::find($id);
        if (!$user){
            abort(404);
        }
        return Helper::SendReponse($user, 'fetch successfully');
    }

    public function store(UserCreateRequest $request){
        $data = collect($request->validated());
        $data['user_type'] = UserTypeEnum::NORMAL->value;
        $data['password'] = Hash::make($data['password']);
        DB::beginTransaction();
        try {
            $user =  Admin::create($data->toArray());
            DB::commit();
            return Helper::SendReponse($user, 'create successfully');
        }
        catch (\Exception $exception){
            return Helper::SendReponse([], $exception->getMessage(), 500);
        }
    }


    public function update($id, UserUpdateRequest $request){
        $data = collect($request->validated())->filter();
        if ($data->has('password')){
            $data['password'] = Hash::make($data['password']);
        }

        DB::beginTransaction();
        $user = Admin::find($id);
        if (!$user){
            abort(404, 'not fond');
        }
        try {
            $user->update($data->toArray());
            DB::commit();
            return Helper::SendReponse($user, 'update successfully');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return Helper::SendReponse([], $exception->getMessage(), 500);
        }
    }


    public function delete($id){
        $user =  Admin::find($id);
        if (!$user){
            abort(404);
        }
        if ($user->user_type == UserTypeEnum::SYSTEM->value){
            return Helper::SendReponse([], 'Can not delete. because this user is for system', 500);
        }

        $user->delete();
        return Helper::SendReponse($user, 'delete successfully');
    }
}
