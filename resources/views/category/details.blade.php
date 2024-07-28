<table class="table">
    @foreach(request()->columns ?? $columns as $column)
        @if($column == "name" || $column == "details")
            @foreach($category->locales() as $lang)
                <tr>
                    <th>{{__('db.category.'.$column)}} {{__('page.in', ['lang' => __('page.'.$lang)])}}</th>
                    <th>:</th>
                    <td>
                        {{$category->$column}}
                    </td>
                </tr>
            @endforeach
        @elseif($column == "image")
            <tr>
                <th>{{__('db.testimonial.'.$column)}}</th>
                <th>:</th>
                <td>
                    <img width="170px" height="170" src="{{$category->$column}}" >
                </td>
            </tr>
        @else
            <tr>
                <th>{{__('db.category.'.$column)}}</th>
                <th>:</th>
                <td>
                    {{$category->$column}}
                </td>
            </tr>
        @endif

    @endforeach
</table>

