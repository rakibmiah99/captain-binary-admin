@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<x-input
    :title="__('page.name')"
    name="name"
    type="text"
    :readonly="false"
    :multi_lang="true"
    :value="$is_edit ? $testimonial->getTranslations('name') : null"
/>


<x-input
    :title="__('page.designation')"
    name="designation"
    type="text"
    :readonly="false"
    :multi_lang="true"
    :value="$is_edit ? $testimonial->getTranslations('designation') : null"
/>

<x-input
    :title="__('page.comments')"
    name="comments"
    type="text-area"
    :readonly="false"
    :multi_lang="true"
    :value="$is_edit ? $testimonial->getTranslations('comments') : null"
/>


<x-input
    :title="__('page.image')"
    name="image"
    type="file"
    :required="$is_edit ? false : true"
/>



