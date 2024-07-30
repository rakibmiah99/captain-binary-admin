<x-main-layout :title="__('menu.category_management')">
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" :name="__('page.categories')" :url="route('category.index')" :url-name="__('page.back')"/>
            <form  action="{{route('category.store')}}" method="post" enctype="multipart/form-data" class="card-body">
                @csrf
                @include('problems.defination_form')
                @include('problems.details_form')

                {{-- <div class="mb-3 row">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label"></label>
                    <button type="submit" class="btn btn-primary col-2">
                        {{__('page.save')}}
                    </button>
                </div> --}}


            </form>
        </div>
    </div>
</x-main-layout>

<script>
$(document).ready(function () {
    let currentStep = 1;

    function showStep(step) {
        $('.form-step').removeClass('form-step-active');
        $('#step' + step).addClass('form-step-active');
    }

    $('.btn-next').click(function () {
        let $currentStep = $('#step' + currentStep);
        if ($currentStep.find('input').filter(function() { return !this.value; }).length === 0) {
            currentStep++;
            if (currentStep > 3) currentStep = 3; // Ensure not to go beyond the last step
            showStep(currentStep);
        } else {

            Toast('Please fill all required fields.', 'error');
        }
    });

    $('.btn-prev').click(function () {
        currentStep--;
        if (currentStep < 1) currentStep = 1; // Ensure not to go below the first step
        showStep(currentStep);
    });

    $('#multiStepForm').submit(function (e) {
        e.preventDefault();
        alert('Form submitted successfully!');
        // You can handle form submission here, e.g., AJAX request
    });

    showStep(currentStep); // Show the first step initially
});
</script>
