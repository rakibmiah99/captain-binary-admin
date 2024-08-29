<div class="form-step" id="step2">
    <h4 class="text-center">Step 2: Problem Details</h4>
    <div class="mb-3 ">
        <label for="instructions_bn" class=" col-form-label">
            Instruction in (Bangla)
            <span class="text-danger asterisk ms-2">*</span>
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <input required="" class="form-control " name="instructions_bn" type="file" value="" id="instructions_bn">
        </div>
    </div>


    <div class="mb-3 ">
        <label for="instructions" class=" col-form-label">
            Instruction in (English)
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <input class="form-control " name="instructions" type="file" value="" id="instructions">
        </div>
    </div>



    <div id="reference-area">
        <div style="background: rgba(105,108,255,.16) !important" class="p-2 reference-form position-relative rounded mt-2">
            <button type="button" class="btn reference-close-btn btn-sm btn-danger position-absolute end-0 top-0 bi bi-x"></button>
            <div class="mb-3 ">
                <label for="reference_title[]" class=" col-form-label">
                    Reference Title
                    <span class="text-danger ms-1"></span>
                </label>
                <div class=" ">
                    <input class="form-control reference_title " name="reference_title[]" type="text" value="" id="reference_title[]">
                </div>
            </div>




            <div class="mb-3 ">
                <label for="reference_link[]" class=" col-form-label">
                    Reference Link
                    <span class="text-danger ms-1"></span>
                </label>
                <div class=" ">
                    <input class="form-control reference_link" name="reference_link[]" type="text" value="" id="reference_link[]">
                </div>
            </div>

        </div>
    </div>
    <button type="button" id="add-more-reference" class="btn mb-3 btn-primary"><i class="bi bi-plus me-2"></i>Add More Reference</button>

    <div class="mb-3 ">
        <label for="code" class=" col-form-label">
            code
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1"></span>
        </label>
        <div class=" ">
            <textarea required="" class="form-control " name="code" id="code" cols="" rows="4" style="display: none;">//write code here</textarea>
        </div>
    </div>


    <div class="mb-3 ">
        <label for="test_case" class=" col-form-label">
            Test Case
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <textarea required="" class="form-control " name="test_case" id="test_case" cols="" rows="4" style="display: none;">//write code here</textarea>
        </div>
    </div>



    <button type="button" class="btn-prev btn btn-seconday">Previous</button>
    <button type="button" class="btn-next btn btn-primary">Next</button>
</div>


<script>
    // $(document).ready(function(){
    let code = codeMirror('code');
    let test_case = codeMirror('test_case');
    // })

    $('#add-more-reference').on('click', function(){
        let rc = $('.reference-form').eq(0).clone();
        let rci = rc.find('input');
        for(let i =0; i < rci.length; i++){
            rci.eq(i).val("");
        }
        $('#reference-area').append(rc)
    })

    $('#reference-area').on('click', '.reference-close-btn', function(){
        if($('.reference-close-btn').length !== 1){
            $(this).parent().remove();
        }
        else{
            $('.reference-form').find('input').each(function (index, input){
                // console.log(input)
                input.value = "";
            });
        }

    })

</script>
