<!-- Step 3 -->
<div class="form-step" id="step3">
    <h2>{{__('page.step_3_review_and_submit')}}</h2>
    <p>{{__('page.review_information')}}</p>


    <table class="table">
        @foreach(array_keys(__('db.problem_in_details')) as $column)
        <tr>
            <th>{{__('db.problem_in_details.'.$column)}}</th>
            <th>:</th>
            
            @if($column == "code" || $column == "test_case")
                <td>
                    <textarea id="review_{{$column}}"></textarea>
                </td>
            @elseif($column == "instructions_bn" || $column == "instructions")
                <td>
                    <iframe style="width: 100%; height: 300px" id="review_{{$column}}"></iframe>
                </td>
            @else
                <td id="review_{{$column}}"></td>
            @endif
        </tr>
    
        @endforeach
    </table>
    
    <div class="mt-4"></div>
    <button type="button" class="btn-prev btn btn-secondary">{{__('page.previous')}}</button>
    <button type="submit" class="btn btn-primary">{{__('page.submit')}}</button>
</div>
<script>
    let review_code = codeMirror('review_code', {readOnly: true});
    let review_test_case = codeMirror('review_test_case', {readOnly: true});
</script>