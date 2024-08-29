<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;

class Helper
{

    public int $perpage = 1;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }


    static public function AdminGuard()
    {
        return Auth::guard('admin');
    }

    static public function SendReponse($data = [], $message = '', $status = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
    static public function ConvertTo12HourFormat($time24) {
        return  date('h:i A', strtotime($time24));
    }

    public static function Paginate(Collection $results, $showPerPage)
    {
        $pageNumber = Paginator::resolveCurrentPage('page');

        $totalPageNumber = $results->count();

        return self::paginator($results->forPage($pageNumber, $showPerPage), $totalPageNumber, $showPerPage, $pageNumber, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param \Illuminate\Support\Collection $items
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @param array $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected static function Paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }


    /**
     * Calculates the growth percentage between two values.
     *
     * If $old_value is not zero, computes the percentage growth from $old_value to $new_value.
     * If $old_value is zero, returns $new_value.
     *
     * @param float $new_value The new value (current value).
     * @param float $old_value The old value (previous value).
     * @return float|int The growth percentage if $old_value is not zero, otherwise returns $new_value.
     */

    public static function GetGrowth($new_value, $old_value)
    {
        /** law of two year percentage change
         *
         *
         *      new value - old value
         *    ------------------------ *  100
         *          old value
         *
         *
         */

        return $old_value ? (($new_value - $old_value) / $old_value ) * 100 : $new_value;
    }


    public static function GenerateFileName($name, $extension): string
    {
        return $name."_".Carbon::now()->format('Y_m_d_H_i').".".$extension;
    }

    public static function PerPage()
    {
        return request()->perpage ?? config('page.per_page_view');
    }

    public static function SetCooke($name, $value, $minutes = 60, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
         return $cookie = cookie($name, $value, $minutes, $path, $domain, $secure, $httpOnly);
//        return response()->cookie($cookie);
    }

    public static function GetCooke($name)
    {
        return Cookie::get($name);
    }

    public static function RemoveCooke($name, $path = null, $domain = null)
    {
        $cookie = cookie()->forget($name, $path, $domain);
//        return response()->cookie($cookie);
    }

    public static function FileUpload($request_key, $path){
        $uploadPath = env("APP_ENV") == "local" ? public_path($path) : base_path($path);
        if ($file = request()->file($request_key)){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            // Save the file path in the database
            $photoPath = request()->root()."/$path/" . $filename;
            return $photoPath;
        }
        else{
            return false;
        }
    }



    public static function RemoveFile($path){
        if($path){
            try{
                $path = explode(request()->root(), $path);
                $path = $path[1];
            }
            catch(\Exception $e){
                $path = null;
            }
        }

        $filePath = env("APP_ENV") == "local" ? public_path($path) : base_path($path);

        // Delete the file from the server
        if ($path && file_exists($filePath)) {
            unlink($filePath);
        }

    }


}
