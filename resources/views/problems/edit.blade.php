@php $is_edit = request()->segment(2) == "edit"  @endphp
<x-main-layout :title="__('menu.company_management')">
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" :name="__('page.problems')" :url="route('problem.index')" :url-name="__('page.back')"/>
            <form action="{{route('problem.update', request()->id)}}" method="post" enctype="multipart/form-data" class="card-body">
                @csrf
                @include('problems.defination_form', compact('is_edit'))
                @include('problems.details_form', compact('is_edit'))
                @include('problems.review_and_submit_form', compact('is_edit'))

                {{-- <div class="mb-3 row">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label"></label>
                    <button type="submit" class="btn btn-primary col-2">
                        {{__('page.save')}}
                    </button>
                </div> --}}


            </form>
        </div>
    </div>
</x-main-layout>

@include('problems.common_script')

