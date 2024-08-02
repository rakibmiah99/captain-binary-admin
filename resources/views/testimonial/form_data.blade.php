@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<x-input
    :title="__('page.name')"
    name="name"
    type="text"
    :readonly="false"
    :required="true"
    :value="$is_edit ? $testimonial->name : null"
/>


<x-input
    :title="__('page.designation')"
    name="designation"
    type="text"
    :readonly="false"
    :required="true"
    :value="$is_edit ? $testimonial->designation : null"
/>

<x-input
    :title="__('page.comments')"
    name="comments"
    type="text-area"
    :readonly="false"
    :required="true"
    :value="$is_edit ? $testimonial->comments : null"
/>


<x-input
    :title="__('page.image')"
    name="image"
    type="file"
    :required="$is_edit ? false : true"
/>



