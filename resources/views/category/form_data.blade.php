@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<x-input
    :title="__('page.name_field', ['lang' => __('page.english')])"
    name="categoryName"
    type="text"
    :readonly="false"
    :required="false"
    :value="$is_edit ? $category->categoryName : null"
/>


<x-input
    :title="__('page.name_field', ['lang' => __('page.bangla')])"
    name="categoryName_bn"
    type="text"
    :readonly="false"
    :required="true"
    :value="$is_edit ? $category->categoryName_bn : null"
/>

<x-input
    :title="__('page.details_field', ['lang' => __('page.english')])"
    name="categoryDetails"
    type="text-area"
    :readonly="false"
    :required="false"
    :value="$is_edit ? $category->categoryDetails : null"
/>

<x-input
    :title="__('page.details_field', ['lang' => __('page.bangla')])"
    name="categoryDetails_bn"
    type="text-area"
    :readonly="false"
    :required="true"
    :value="$is_edit ? $category->categoryDetails_bn : null"
/>

<x-input
    :title="__('page.image')"
    name="image"
    type="file"
    :required="$is_edit ? false : true"
/>



