<table class="table">
    @foreach(request()->columns ?? $columns as $column)
        <tr>
            <th>{{__('db.contact.'.$column)}}</th>
            <th>:</th>
            <td>
                {{$contact->$column}}
            </td>
        </tr>
    @endforeach
</table>

