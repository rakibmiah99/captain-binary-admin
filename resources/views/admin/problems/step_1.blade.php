<div class="form-step form-step-active" id="step1">
    <h4 class="text-center">Step 1: Problem Defination</h4>
    <div class="mb-3 ">
        <label for="title_bn" class=" col-form-label">
            Name in (Bangla)
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <input required="" class="form-control " name="title_bn" type="text" value="" id="title_bn">
        </div>
    </div>


    <div class="mb-3 ">
        <label for="title" class=" col-form-label">
            Name in (English)
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <input class="form-control " name="title" type="text" value="" id="title">
        </div>
    </div>



    <div class="mb-3 ">
        <label for="difficulty" class=" col-form-label">
            Dificulty Label
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1"></span>
        </label>
        <div class="">
            <select required="" name="difficulty" class="form-select " id="difficulty">
                <option value="">Select</option>
                <option value="Very Easy">Very Easy</option>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
                <option value="Very Hard">Very Hard</option>
            </select>
        </div>
    </div>

    <div class="mb-3 ">
        <label for="point" class=" col-form-label">
            Points
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <input required="" class="form-control " name="point" type="number" value="" id="point" min="1">
        </div>
    </div>

    <div class="mb-3 ">
        <label for="tags" class=" col-form-label">
            Tags
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <input required="" class="form-control " name="tags" type="text" value="" id="tags">
        </div>
    </div>


    <div class="mb-3 ">
        <label for="category_id" class=" col-form-label">
            Category
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1">
    </span>

        </label>
        <div class="">
            <select required="" name="category_id" class="form-select" >
                <option value="">Select</option>
            </select>
        </div>
    </div>








    <div class="mb-3 ">
        <label for="description_bn" class=" col-form-label">
            Details in (Bangla)
            <span class="text-danger ms-2">*</span>
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <textarea required="" class="form-control " name="description_bn" id="description_bn" cols="" rows="4"></textarea>
        </div>
    </div>


    <div class="mb-3 ">
        <label for="description" class=" col-form-label">
            Details in (English)
            <span class="text-danger ms-1">
    </span>
        </label>
        <div class=" ">
            <textarea class="form-control " name="description" id="description" cols="" rows="4"></textarea>
        </div>
    </div>



    <button type="button" class="btn-next btn btn-primary">Next</button>
</div>


<script>
    $(document).ready(function (){
        requestData.get('/category/all', {
            method: 'GET'
        }).then(function (response){
            console.log(response.data)
            let data = response.data.data;
            let category_el = $('select[name=category_id]');
            data.forEach(function (item){
                category_el.append(`<option value="${item.id}">${item.categoryName_bn}</option>`)
            })

        }).catch(function (error){

        })
    })
</script>
