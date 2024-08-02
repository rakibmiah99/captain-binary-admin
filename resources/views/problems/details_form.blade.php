@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp
<div class="form-step" id="step2">
    <h4 class="text-center">{{__('page.step_2_problem_details')}}</h2>             
    <x-input
        :title="__('page.instruction_field', ['lang' => __('page.bangla')])"
        name="instructions_bn"
        type="file"
        :readonly="false"
        :required="$is_edit ? false : true"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />

    <x-input
        :title="__('page.instruction_field', ['lang' => __('page.english')])"
        name="instructions"
        type="file"
        :readonly="false"
        :required="false"
        {{-- :value="$is_edit ? $category->categoryName_bn : null" --}}
    />


    <x-input
        :title="__('page.reference_title')"
        name="reference_title"
        type="text"
        :readonly="false"
        :required="false"
        :value="$is_edit ? $problem->references?->reference_title : old('reference_title')"
    />


    
    <x-input
        :title="__('page.reference_link')"
        name="reference_link"
        type="text"
        :readonly="false"
        :required="false"
        :value="$is_edit ? $problem->references?->reference_link : old('reference_link')"
    />

    <x-input
        :title="__('page.code')"
        name="code"
        type="text-area"
        :readonly="false"
        :required="true"
        :value="$is_edit ? $problem->details?->code :'//write code here'"
        :decode="true"
    />

    <x-input
        :title="__('page.test_case')"
        name="test_case"
        type="text-area"
        :readonly="false"
        :required="true"
        :value="$is_edit ? $problem->details?->test_case : '//write code here'"
        :decode="true"
    />


    <button type="button" class="btn-prev btn btn-seconday">{{__('page.previous')}}</button>
    <button type="button" class="btn-next btn btn-primary">{{__('page.next')}}</button>
</div>

<script>
    // $(document).ready(function(){
        let code = codeMirror('code');
        let test_case = codeMirror('test_case');
    // })

</script>
