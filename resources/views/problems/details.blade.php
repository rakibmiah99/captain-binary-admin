<table class="table">
    @foreach(request()->columns ?? $columns as $column)
    <tr>
        <th>{{__('db.problem_in_details.'.$column)}}</th>
        <th>:</th>
        <td>
            @if($column == "image")
                <img src="{{$problem->$column}}" height="150px">
            @else 
                {{$problem->$column}}
            @endif
        </td>
    </tr>

    @endforeach
</table>

