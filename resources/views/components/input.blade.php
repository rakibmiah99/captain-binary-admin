@php
    $mode = $attributes->get('mode') ?? 'vertical'; //vertical,horizontal
    $name = $attributes->get('name');
    $size = $attributes->get('size');
    $title = $attributes->get('title');
    $after_label = $attributes->get('after-label');
    $value = $attributes->get('value');
    $min = $attributes->get('min');
    $max = $attributes->get('max');
    $cols = $attributes->get('col');
    $rows = $attributes->get('row') ?? 4;
    $type = $attributes->get('type') ?? "text";
    $input_size = "";
    $label_size = "";
    if ($mode == "horizontal"){
        $input_size = $attributes->get('input-size') ?? 'col-md-10';
        $label_size = $attributes->get('label-size') ?? 'col-md-2';
    }

    $required = $attributes->get('required') ?? false;
    $is_multi_lang = $attributes->get('multi_lang') ?? false;
    $readonly = $attributes->get('readonly') ?? false;
    $disabled = $attributes->get('disabled') ?? false;

@endphp
@if($is_multi_lang)
    @foreach(config('settings.language') as $lang=>$config)
        @php
            $translatable_value = $value === null ? old($name.".".$lang) : $value[$lang] ?? '';
        @endphp


        <div class="mb-3 {{$mode == 'horizontal' ? 'row' : '' }}" >
            <label @if($size) style="font-size: 10px"  @endif for="{{$name}}" class="{{ $label_size  }} col-form-label">
                {{$title}} in ({{$config['translation-key']}})
                @php echo $after_label; @endphp
                @if($config['required'] === true))
                    <x-required/>
                @endif
                <x-input-error :name="$name.'.'.$lang"/>
            </label>
            <div class="{{$input_size}} ">
                @if($type != "text-area")
                    <input
                        @if($config['required'] === true) required @endif
                        @if($readonly) readonly @endif
                        @if($disabled) disabled @endif
                        class="form-control {{$size}}"
                        name="{{$name."[".$lang."]"}}"
                        type="{{$type}}"
                        value="{{$translatable_value}}"
                        id="{{$name}}"
                        @if($min) min="{{$min}}" @endif
                        @if($max) max="{{$max}}" @endif
                    >
                @else
                    <textarea
                        @if($config['required'] === true) required @endif
                        @if($readonly) readonly @endif
                        @if($disabled) disabled @endif
                        class="form-control {{$size}}"
                        name="{{$name."[".$lang."]"}}"
                        id="{{$name}}"
                        @if($min) min="{{$min}}" @endif
                        @if($max) max="{{$max}}" @endif
                        cols="{{$cols}}"
                        rows="{{$rows}}"
            >{{$translatable_value}}</textarea>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div class="mb-3 {{$mode == 'horizontal' ? 'row' : '' }}" >
        <label @if($size) style="font-size: 10px"  @endif for="{{$name}}" class="{{ $label_size  }} col-form-label">
            {{$title}}
            @php echo $after_label; @endphp
            @if($required)
                <x-required/>
            @endif
            <x-input-error name="{{$name}}"/>
        </label>
        <div class="{{$input_size}} ">
            @if($type != "text-area")
                <input
                    @if($required) required @endif
                @if($readonly) readonly @endif
                    @if($disabled) disabled @endif
                    class="form-control {{$size}}" name="{{$name}}"
                    type="{{$type}}"
                    value="{{$value ?? old($name)}}"
                    id="{{$name}}"
                    @if($min) min="{{$min}}" @endif
                    @if($max) max="{{$max}}" @endif
                >
            @else
                <textarea
                    @if($required) required @endif
                @if($readonly) readonly @endif
                    @if($disabled) disabled @endif
                    class="form-control {{$size}}" name="{{$name}}"
                    id="{{$name}}"
                    @if($min) min="{{$min}}" @endif
                    @if($max) max="{{$max}}" @endif
                    cols="{{$cols}}"
                    rows="{{$rows}}"
            >{{$value ?? old($name)}}</textarea>
            @endif
        </div>
    </div>
@endif

