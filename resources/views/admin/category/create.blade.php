<x-create-modal size="modal-lg" title="Create Testimonial">
    <form action="category/store" method="post" enctype="multipart/form-data" class="card-body create-form">
        <input type="hidden" name="_token" value="TDJKxj9NzieQnKjItbRFjIhWxLGisbMXu8r1KsEU" autocomplete="off">                <div class="mb-3 ">
            <label for="categoryName" class=" col-form-label">
                Name in (English)
                <span class="text-danger ms-1"></span>
            </label>
            <div class=" ">
                <input class="form-control " name="categoryName" type="text" value="" id="categoryName">
            </div>
        </div>



        <div class="mb-3 ">
            <label for="categoryName_bn" class=" col-form-label">
                Name in (Bangla)
                <span class="text-danger ms-2">*</span>
                <span class="text-danger ms-1"></span>
            </label>
            <div class=" ">
                <input required="" class="form-control " name="categoryName_bn" type="text" value="" id="categoryName_bn">
            </div>
        </div>


        <div class="mb-3 ">
            <label for="categoryDetails" class=" col-form-label">
                Details in (English)
                <span class="text-danger ms-1"></span>
            </label>
            <div class=" ">
                <textarea class="form-control " name="categoryDetails" id="categoryDetails" cols="" rows="4"></textarea>
            </div>
        </div>


        <div class="mb-3 ">
            <label for="categoryDetails_bn" class=" col-form-label">
                Details in (Bangla)
                <span class="text-danger ms-2">*</span>
                <span class="text-danger ms-1"></span>
            </label>
            <div class=" ">
                <textarea required="" class="form-control " name="categoryDetails_bn" id="categoryDetails_bn" cols="" rows="4"></textarea>
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
