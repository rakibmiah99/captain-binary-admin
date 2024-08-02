@php
    $mode = $attributes->get('mode') ?? 'vertical'; //vertical,horizontal
    $name = $attributes->get('name');
    $size = $attributes->get('size');
    $array = $attributes->get('array');
    $column = $attributes->get('column') ?? 'id';
    $display_column = $attributes->get('display_column') ?? 'name';
    $is_required = $attributes->get('is_required');
    $is_multiple = $attributes->get('multiple');
    $title = $attributes->get('title');
    $value = $attributes->get('value');
    $input_size = "";
    $label_size = "";
    if ($mode == "horizontal"){
        $input_size = $attributes->get('input-size') ?? 'col-md-10';
        $label_size = $attributes->get('label-size') ?? 'col-md-2';
    }


    //if you need multiple with code input box
    $key = $attributes->get('key') ?? 0;
@endphp

<div class="mb-3 {{$mode == "horizontal" ? 'row' : ''}}">
    <label @if($size) style="font-size: 10px" @endif for="{{$name}}" class="{{$label_size}} col-form-label">
        {{$title}}
        @if($is_required)
            <x-required/>
            <x-input-error name="{{$name}}"/>
        @endif

    </label>
    <div class="{{$input_size}}">
        <select @if($is_multiple) multiple @endif @if($is_required) required @endif name="{{$name}}" class="form-select {{$size}} select-2" id="{{$name}}">
            <option value="">{{__('page.select')}}</option>
            @foreach($array as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
</div>

@if($value)
    <script>
        @if(isset($is_multiple) && $is_multiple === true)
            $('#{{$name}}').val({{json_encode($value)}});
        @else
            $('#{{$name}}').val('{{$value}}');
        @endif

    </script>
@endif




