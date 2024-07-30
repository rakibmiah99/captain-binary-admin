<table class="table">
    @foreach(request()->columns ?? $columns as $column)
    <tr>
        <th>{{__('db.category.'.$column)}}</th>
        <th>:</th>
        <td>
            @if($column == "image")
                <img src="{{$category->$column}}" height="150px">
            @else 
                {{$category->$column}}
            @endif
        </td>
    </tr>

    @endforeach
</table>

