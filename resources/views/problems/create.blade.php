<x-main-layout :title="__('menu.category_management')">
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" :name="__('page.problems')" :url="route('problem.index')" :url-name="__('page.back')"/>
            <form  action="{{route('problem.store')}}" method="post" enctype="multipart/form-data" class="card-body">
                @csrf
                @include('problems.defination_form')
                @include('problems.details_form')
                @include('problems.review_and_submit_form')
            </form>
        </div>
    </div>
</x-main-layout>

@include('problems.common_script')
