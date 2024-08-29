<x-create-modal size="modal-xl" title="Create Problem">
    <form action="/problem/store" method="post" enctype="multipart/form-data" class="card-body create-form">
        @include('admin.problems.step_1')
        @include('admin.problems.step_2')
        @include('admin.problems.step_3')

        {{--<div class="mb-3 px-2 row">
            <!--SAVE BUTTON -->
            <button type="submit" class="btn btn-primary save-btn">
                <span>Save</span>
            </button>

            <!--LOADING BUTTON -->
            <button type="button" class="btn d-none  btn-primary save-loading-btn">
                <span class="d-block py-0 bg-primary">
                    <span class="spinner-border  text-white spinner-border-lg " role="status">
                    <span class="visually-hidden">Loading...</span>
                </span>
                </span>
            </button>
        </div>--}}


    </form>

    @include('admin.problems.script')
</x-create-modal>


<script>
    $('.create-form').on('submit', function (e){
        e.preventDefault();
        let url = $(this).attr('action')
        let serialize_form_data = $(this).serializeArray();
        var instructions_bn_el = document.querySelector('input[name="instructions_bn"]');
        var instructions_el = document.querySelector('input[name="instructions"]');

        // Get the file from the input element
        var instructions_bn = instructions_bn_el.files[0];
        var instructions = instructions_el.files[0];
        let form_data = new FormData();
        if(instructions_bn){
            form_data.set('instructions_bn', instructions_bn)
        }
        if(instructions){
            form_data.set('instructions', instructions)
        }


        serialize_form_data.forEach(function (input){
            form_data.append(input.name, input.value)
        })
        saveButtonLoaderON();

        console.log(form_data)
        requestData.post(url, form_data, {
            'Content-Type': 'multipart/form-data'
        }).then(function (response){
            saveButtonLoaderOFF();
            $('#createModal').modal('hide')
            getData()
        }).catch(function (error){
            console.log(error)
        })
    })
</script>
