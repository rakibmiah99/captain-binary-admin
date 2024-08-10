<table class="table">
    @foreach(request()->columns ?? $columns as $column)
        
            <tr>
                <th>{{__('db.testimonial.'.$column)}}</th>
                <th>:</th>
                <td>
                    @if($column == "image")
                        <img src="{{$testimonial->$column}}" height="100px" width="100px"/>
                    @else 
                        {{$testimonial->$column}}
                    @endif
                </td>
            </tr>

    @endforeach
</table>

