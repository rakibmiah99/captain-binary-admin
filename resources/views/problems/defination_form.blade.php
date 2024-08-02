@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp
<div class="form-step form-step-active" id="step1">
    <h4 class="text-center">{{__('page.step_1_problem_defination')}}</h2>             
    <x-input
        :title="__('page.name_field', ['lang' => __('page.bangla')])"
        name="title_bn"
        type="text"
        :readonly="false"
        :required="true"
        :value="$is_edit ? $problem->title_bn : old('title_bn')"
    />

    <x-input
        :title="__('page.name_field', ['lang' => __('page.english')])"
        name="title"
        type="text"
        :readonly="false"
        :required="false"
        :value="$is_edit ? $problem->title : old('title')"
    />

    
    <x-select
        :title="__('page.dificulty_label')"
        :is_required="true"
        :array="\App\Enums\DificultyLabelEnum::toArray()"
        name="difficulty"
        :value="$is_edit ? $problem->difficulty : old('difficulty')"
    />

    <x-input
        :title="__('page.points')"
        name="point"
        type="number"
        min="1"
        :readonly="false"
        :required="true"
        :value="$is_edit ? $problem->point : old('point')"
    />

    
    <x-input
        :title="__('page.tags')"
        name="tags"
        type="text"
        :readonly="false"
        :required="true"
        :value="$is_edit ? $problem->tags : old('tags')"
    />

    <x-input-select2
        :title="__('page.category')"
        :is_required="true"
        :array="\App\Models\Category::get()"
        column="id"
        display_column='categoryName'
        name="category_id"
        :value="$is_edit ? $problem->category_id : old('category_id')"
    />

    <x-input
        :title="__('page.details_field', ['lang' => __('page.bangla')])"
        name="description_bn"
        type="text-area"
        :readonly="false"
        :required="true"
        :value="$is_edit ? $problem->description_bn : old('description_bn')"
    />

    <x-input
        :title="__('page.details_field', ['lang' => __('page.english')])"
        name="description"
        type="text-area"
        :readonly="false"
        :required="false"
        :value="$is_edit ? $problem->description : old('description')"
    />
    

    <button type="button" class="btn-next btn btn-primary">{{__('page.next')}}</button>
</div>
