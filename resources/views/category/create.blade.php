<x-main-layout :title="__('menu.category_management')">
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" :name="__('page.categories')" :url="route('category.index')" :url-name="__('page.back')"/>
            <form  action="{{route('category.store')}}" method="post" enctype="multipart/form-data" class="card-body">
                @csrf
                @include('category.form_data')

                <div class="mb-3 row">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label"></label>
                    <button type="submit" class="btn btn-primary col-2">
                        {{__('page.save')}}
                    </button>
                </div>


            </form>
        </div>
    </div>
</x-main-layout>

@include('company.common_script')
