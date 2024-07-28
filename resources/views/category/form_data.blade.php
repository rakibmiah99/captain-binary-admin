@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<x-input
    :title="__('page.name')"
    name="name"
    type="text"
    :readonly="false"
    :multi_lang="true"
    :value="$is_edit ? $category->getTranslations('name') : null"
/>


<x-input
    :title="__('page.details')"
    name="details"
    type="text-area"
    :readonly="false"
    :multi_lang="true"
    :value="$is_edit ? $category->getTranslations('details') : null"
/>


<x-input
    :title="__('page.image')"
    name="image"
    type="file"
    :required="$is_edit ? false : true"
    :value="$is_edit ? $category->code : ''"
/>



