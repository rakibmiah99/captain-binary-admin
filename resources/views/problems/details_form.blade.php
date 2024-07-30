<div class="form-step" id="step2">
    <h4 class="text-center">Step 1: Problem Details</h2>             
    <x-input
        :title="__('page.instruction_field', ['lang' => __('page.bangla')])"
        name="categoryName_bn"
        type="text"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input
        :title="__('page.instruction_field', ['lang' => __('page.english')])"
        name="categoryName_bn"
        type="text"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input
        :title="__('page.code')"
        name="categoryName_bn"
        type="text-area"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input
        :title="__('page.test_case')"
        name="categoryName_bn"
        type="text-area"
        :readonly="false"
        :required="true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />


    <button type="button" class="btn-prev btn btn-seconday">Previous</button>
    <button type="button" class="btn-next btn btn-primary">Next</button>
</div>