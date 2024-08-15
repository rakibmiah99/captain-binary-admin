@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp
<div class="form-step" id="step2">
    <h4 class="text-center">{{__('page.step_2_problem_details')}}</h4>
    <x-input
        :title="__('page.instruction_field', ['lang' => __('page.bangla')])"
        name="instructions_bn"
        type="file"
        :readonly="false"
        :required="$is_edit ? false : true"
{{--         :value="null"--}}
    />

    <x-input
        :title="__('page.instruction_field', ['lang' => __('page.english')])"
        name="instructions"
        type="file"
        :readonly="false"
        :required="false"
{{--        :value="null"--}}
    />


    <div id="reference-area">
        @if($is_edit && $problem->references->count() > 0)
            @foreach($problem->references as $reference)
                <div style="background: rgba(105,108,255,.03) !important" class="p-2 position-relative reference-form rounded mt-2">
                    <button type="button" class="btn reference-close-btn btn-sm btn-danger position-absolute end-0 top-0 bi bi-x"></button>
                    <x-input
                        :title="__('page.reference_title')"
                        name="reference_title[]"
                        type="text"
                        :readonly="false"
                        :required="false"
                        multiple=true
                        :value="$is_edit ? $reference->reference_title : old('reference_title')"
                    />



                    <x-input
                        :title="__('page.reference_link')"
                        name="reference_link[]"
                        type="text"
                        :readonly="false"
                        :required="false"
                        :value="$is_edit ? $reference->reference_link : old('reference_link')"
                    />
                </div>
            @endforeach

        @else
            <div style="background: rgba(105,108,255,.16) !important" class="p-2 reference-form position-relative rounded mt-2">
                <button type="button" class="btn reference-close-btn btn-sm btn-danger position-absolute end-0 top-0 bi bi-x"></button>
                <x-input
                    :title="__('page.reference_title')"
                    name="reference_title[]"
                    type="text"
                    :readonly="false"
                    :required="false"
                    :value="$is_edit ? '' : old('reference_title')"
                />



                <x-input
                    :title="__('page.reference_link')"
                    name="reference_link[]"
                    type="text"
                    :readonly="false"
                    :required="false"
                    :value="$is_edit ? '' : old('reference_link')"
                />
            </div>
        @endif
    </div>
    <button type="button" id="add-more-reference" class="btn mb-3 btn-primary"><i class="bi bi-plus me-2"></i>Add More Reference</button>

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

    $('#add-more-reference').on('click', function(){
        let rc = $('.reference-form').eq(0).clone();
        let rci = rc.find('input');
        for(let i =0; i < rci.length; i++){
            rci.eq(i).val("");
        }
        $('#reference-area').append(rc)
    })

    $('#reference-area').on('click', '.reference-close-btn', function(){
        if($('.reference-close-btn').length !== 1){
            $(this).parent().remove();
        }
        else{
            $('.reference-form').find('input').each(function (index, input){
                // console.log(input)
                input.value = "";
            });
        }

    })

</script>
