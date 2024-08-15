<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\Testimonial\TestimonialCreateRequest;
use App\Http\Requests\Testimonial\TestimonialUpdateRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonalController extends Controller
{
    public function index(Request $request){
        $columns = array_keys(__('db.testimonial'));
        $data = Testimonial::filter()->paginate(Helper::PerPage())->withQueryString();
        return view('testimonial.index', compact('data', 'columns'));
    }

    public function show($id){
        $testimonial = Testimonial::find($id);
        if (!$testimonial){
            abort(404);
        }
        $columns = array_keys(__('db.testimonial'));

        return view('testimonial.details', compact('testimonial', 'columns'));
    }

    public function create(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('testimonial.create');
    }

    public function edit($id, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial){
            abort(404);
        }
        return view('testimonial.edit', compact('testimonial'));
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
            return redirect()->route('testimonial.index')->with('success', Helper::CreatedSuccessFully());
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
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
            return redirect()->route('testimonial.index')->with('success', Helper::UpdatedSuccessFully());
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


    public function delete($id){
        try {
            $testimonial = Testimonial::find($id);
            if (!$testimonial){
                abort(404);
            }
            $testimonial->delete();
            Helper::RemoveFile($testimonial->img);
            return redirect()->back()->with('success', Helper::DeletedSuccessFully());
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
