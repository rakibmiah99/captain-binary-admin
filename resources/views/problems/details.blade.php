<table class="table">
    @foreach(request()->columns ?? $columns as $column)
    <tr>
        <th>{{__('db.problem_in_details.'.$column)}}</th>
        <th>:</th>
        <td>
            @if($column == "references")
                @foreach($problem->references as $reference)
                <p><b>Title: </b> {{$reference->reference_title}}</p>
                <p><b>Link: </b> {{$reference->reference_link}}</p>
                @endforeach
            @elseif($column == "code" || $column == "test_case")
                <textarea id="view_{{$column}}">@php echo $problem->details?->$column; @endphp</textarea>
            @elseif($column == "instructions_bn" || $column == "instructions")
                <iframe src="{{$problem->details?->$column}}" style="width: 100%; height: 300px" id="view_{{$column}}"></iframe>
            @else
                {{$problem->$column}}
            @endif
        </td>
    </tr>

    @endforeach
</table>

<script>
    var v_code = codeMirror('view_code', {readOnly: true}, true);
    var v_test_case = codeMirror('view_test_case', {readOnly: true}, true);
</script>

