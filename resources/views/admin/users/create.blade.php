<x-create-modal size="modal-lg" title="Create Testimonial">
    <form action="/users/store" method="post" enctype="multipart/form-data" class="card-body create-form">
        <div class="col-md-12">
            <div class="mb-3 ">
                <label for="name" class=" col-form-label">
                    Name
                    <span class="text-danger ms-2">*</span>
                    <span class="text-danger ms-1"></span>
                </label>
                <div class=" ">
                    <input required="" class="form-control " name="name" type="text" value="" id="name">
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="mb-3 ">
                <label for="email" class=" col-form-label">
                    Email
                    <span class="text-danger ms-2">*</span>
                    <span class="text-danger ms-1"></span>
                </label>
                <div class=" ">
                    <input required="" class="form-control " name="email" type="email" value="" id="email">
                </div>
            </div>

        </div>



        <div class="col-md-12">
            <div class="mb-3 ">
                <label for="password" class=" col-form-label">
                    Password
                    <span class="text-danger ms-2">*</span>
                    <span class="text-danger ms-1"></span>
                </label>
                <div class=" ">
                    <input required="" class="form-control " name="password" type="password" value="" id="password">
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="mb-3 ">
                <label for="confirm_password" class=" col-form-label">
                    Confirmed Password
                    <span class="text-danger ms-2">*</span>
                    <span class="text-danger ms-1"></span>
                </label>
                <div class=" ">
                    <input required="" class="form-control " name="confirm_password" type="password" value="" id="confirm_password">
                </div>
            </div>

        </div>





        <div class="mb-3 px-2 row">
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
        </div>


    </form>
</x-create-modal>

<script>
    $('.create-form').on('submit', function (e){
        e.preventDefault();
        let url = $(this).attr('action')
        let serialize_form_data = $(this).serializeArray();
        let form_data = new FormData();


        serialize_form_data.forEach(function (input){
            form_data.set(input.name, input.value)
        })
        saveButtonLoaderON();
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
