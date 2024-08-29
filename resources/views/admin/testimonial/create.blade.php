<x-create-modal title="Create Testimonial">
    <form action="testimonial/store" method="post" enctype="multipart/form-data" class="card-body create-form">
        <input type="hidden" name="_token" value="k2hEeP2qahD2iDAe4axh8xTT2FBWDlHK5R45sa0j" autocomplete="off">                <div class="mb-3 ">
            <label for="name" class=" col-form-label">
                Name
                <span class="text-danger ms-2">*</span>
                <span class="text-danger ms-1"></span>
            </label>
            <div class="">
                <input required="" class="form-control " name="name" type="text" value="" id="name">
            </div>
        </div>



        <div class="mb-3 ">
            <label for="designation" class=" col-form-label">
                Designation
                <span class="text-danger ms-2">*</span>
                <span class="text-danger ms-1"></span>
            </label>
            <div class=" ">
                <input required="" class="form-control " name="designation" type="text" value="" id="designation">
            </div>
        </div>


        <div class="mb-3 ">
            <label for="comments" class=" col-form-label">
                Comments
                <span class="text-danger ms-2">*</span>
                <span class="text-danger ms-1"></span>
            </label>
            <div class=" ">
                <textarea required="" class="form-control " name="comments" id="comments" cols="" rows="4"></textarea>
            </div>
        </div>



        <div class="mb-3 ">
            <label for="image" class="col-form-label">
                Image
                <span class="text-danger asterisk ms-2">*</span>
                <span class="text-danger error-message ms-1"></span>
            </label>
            <div class="">
                <input required="" class="form-control " name="image" type="file" value="" id="image">
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
        var imageInput = document.querySelector('input[name="image"]');

        // Get the file from the input element
        var image = imageInput.files[0];
        let form_data = new FormData();
        if(image){
            form_data.set('image', image)
        }


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
