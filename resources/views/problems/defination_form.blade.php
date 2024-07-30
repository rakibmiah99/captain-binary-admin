<div class="form-step form-step-active" id="step1">
    <h4 class="text-center">Step 1: Problem Defination</h2>             
    <x-input
        :title="__('page.name_field', ['lang' => __('page.bangla')])"
        name="categoryName_bn"
        type="text"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input
        :title="__('page.name_field', ['lang' => __('page.english')])"
        name="categoryName_bn"
        type="text"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    
    <x-select
        :title="__('page.dificulty_label')"
        :is_required="true"
        :array="\App\Enums\DificultyLabelEnum::toArray()"
        name="country_id"
        {{-- :value="$is_edit ? $company->country_id : ''" --}}
    />

    <x-input
        :title="__('page.points')"
        name="categoryName_bn"
        type="text"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    
    <x-input
        :title="__('page.tags')"
        name="categoryName_bn"
        type="text"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input-select2
        :title="__('page.category')"
        :is_required="true"
        :array="\App\Models\Category::get()"
        column="id"
        display_column='categoryName'
        name="country_id"
        {{-- :value="$is_edit ? $company->country_id : ''" --}}
    />

    <x-input
        :title="__('page.details_field', ['lang' => __('page.bangla')])"
        name="categoryName_bn"
        type="text-area"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input
        :title="__('page.details_field', ['lang' => __('page.english')])"
        name="categoryName_bn"
        type="text-area"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />


    <button type="button" class="btn-next btn btn-primary">Next</button>
</div>