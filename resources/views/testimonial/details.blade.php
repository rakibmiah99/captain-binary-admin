<table class="table">
    @foreach(request()->columns ?? $columns as $column)
        @if($column == "name" || $column == "designation" || $column == "comments")
            @foreach($testimonial->locales() as $lang)
                <tr>
                    <th>{{__('db.testimonial.'.$column)}} {{__('page.in', ['lang' => __('page.'.$lang)])}}</th>
                    <th>:</th>
                    <td>
                        {{$testimonial->$column}}
                    </td>
                </tr>
            @endforeach

        @elseif($column == "image")
            <tr>
                <th>{{__('db.testimonial.'.$column)}}</th>
                <th>:</th>
                <td>
                    <img width="70px" height="70" src="{{$testimonial->$column}}" >
                </td>
            </tr>

        @else
            <tr>
                <th>{{__('db.testimonial.'.$column)}}</th>
                <th>:</th>
                <td>
                    {{$testimonial->$column}}
                </td>
            </tr>
        @endif

    @endforeach
</table>

