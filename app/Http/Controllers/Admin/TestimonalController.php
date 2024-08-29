<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper;
use App\Http\Requests\Testimonial\TestimonialCreateRequest;
use App\Http\Requests\Testimonial\TestimonialUpdateRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonalController extends Controller
{
    public function index(Request $request){
        $data = Testimonial::filter()->paginate(Helper::PerPage())->withQueryString();
        return Helper::SendReponse($data, 'fetch successfully');
    }

    public function show($id){
        $testimonial = Testimonial::find($id);
        if (!$testimonial){
            abort(404);
        }

        return Helper::SendReponse($testimonial, 'fetch successfully');
    }

    public function store(TestimonialCreateRequest $request){

        $data = collect($request->validated())
        ->merge([
            'img' => Helper::FileUpload(request_key: 'image', path: 'photos')
        ])
        ->except('image')
        ->toArray();

        try {
            $testimonial = Testimonial::create($data);
            return Helper::SendReponse($testimonial, 'Created Successfully');
        }
        catch (\Exception $exception){
            return Helper::SendReponse($exception->getMessage(), 'error', 500);
        }
    }


    public function update($id, TestimonialUpdateRequest $request){
        $testimonial = Testimonial::find($id);
        $data = collect($request->validated())
        ->except('image');

        if($path = Helper::FileUpload(request_key: 'image', path: 'photos')){
            $data = $data->merge(['img' => $path]);
            Helper::RemoveFile($testimonial->img);
        }

        if (!$testimonial){
            abort(404);
        }

        try{
            $testimonial->update($data->toArray());
            return Helper::SendReponse($testimonial, 'Updated Successfully');
        }
        catch (\Exception $exception){
            return Helper::SendReponse($exception->getMessage(), 'error', 500);
        }
    }


    public function delete($id){
        $testimonial = Testimonial::find($id);
        if (!$testimonial){
            abort(404);
        }
        $testimonial->delete();
        Helper::RemoveFile($testimonial->img);
        return Helper::SendReponse($testimonial, 'Deleted Successfully');
    }
}
