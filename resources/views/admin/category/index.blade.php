@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0">Category List</h5>
            <button class="btn btn-sm btn-primary create-btn" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
        </div>

        <hr class="mt-0">
        <x-table-search-form/>
        <x-table-data>
            <tr>
                <th>sl</th>
                <th>name en</th>
                <th>name bn</th>
                <th>item Total</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </x-table-data>
        <x-delete-modal/>
        <x-view-modal size="modal-lg" title="Show Category">
            <table class="table" >
                <thead id="show-data">

                </thead>
            </table>
        </x-view-modal>
        @include('admin.category.create')
    </div>

    <script>
        getData()
        function getData(params = getUrlParams()){
            progressBarON();
            requestData.get('/category', {
                params: params,
            })
            .then(function (response){
                if (response.status === 200){
                    let response_data = response.data.data;
                    progressBarOFF();
                    //Cards Data Count
                    $('#table-contents').empty();
                    $('#paginations').empty();
                    let index = response_data.per_page * (response_data.current_page -1)
                    response_data.data.forEach(function (item){
                        appendRow('#table-contents', item, ++index)
                    })

                    if(response_data.links.length > 3) {
                        response_data.links.forEach(function (link) {
                            appendPaginateButton('#paginations', link)
                        })
                    }


                }
            })
            .catch(function (error){
                console.log(error)
            })
        }


        //deleteData() method exists in delete-modal component
        deleteData('/category/delete/:id')


        //Show Data
        $('#table-contents').on('click', '.table-show-btn', function (){
            let id = $(this).attr('data-id');
            requestData('/category/show/'+id, {
                method: 'GET'
            }).then(function (response){
                console.log(response.data)
                let data = response.data.data;
                showData('#show-data', data)

            }).catch(function (error){

            })
        });

        //Show Data
        $('#table-contents').on('click', '.table-edit-btn', function (){
            let id = $(this).attr('data-id');
            setFormUrl('/category/update/'+id, 'edit');
            modalLoaderON()
            requestData('/category/show/'+id, {
                method: 'GET'
            }).then(function (response){
                let data = response.data.data;
                setFormData(data.categoryName, data.categoryName_bn, data.categoryDetails, data.categoryDetails_bn);
                modalLoaderOFF();
            }).catch(function (error){

            });
        });


        $('.create-btn').on('click', () => {
            modalLoaderOFF();
            setFormUrl('/category/store')
        })


        function setFormData(categoryName= "", categoryName_bn = "", categoryDetails = "", categoryDetails_bn = "", ){
            let createForm = $('.create-form');
            createForm.find('input[name=categoryName]').val(categoryName)
            createForm.find('input[name=categoryName_bn]').val(categoryName_bn)
            createForm.find('textarea[name=categoryDetails]').val(categoryDetails)
            createForm.find('textarea[name=categoryDetails_bn]').val(categoryDetails_bn)
            // createForm.find('textarea[name=image]').val("")
        }


        function setFormUrl(url, form_mode = 'create'){
            let createForm = $('.create-form');
            let image_wrapper = createForm.find('input[name=image]').parent().parent();
            if(createForm.attr('form-mode') === "edit" && form_mode === "create"){
                setFormData()
            }

            if(form_mode === 'create'){
                image_wrapper.find('.asterisk').removeClass('d-none');
                image_wrapper.find('input').attr('required', true)
            }
            else{
                image_wrapper.find('.asterisk').addClass('d-none')
                image_wrapper.find('input').attr('required', false)
            }

            createForm.attr('form-mode', form_mode)
            createForm.attr('action', url)
        }

        function appendRow(selector,item, index = 1){
            $(selector).append(`
                 <tr>
                    <td><strong>${index}</strong></td>
                    <td><strong>${printWithLimit(item.categoryName, 15)}</strong></td>
                    <td>${printWithLimit(item.categoryName_bn, 15)}</td>
                    <td>${item.itemTotal}</td>
                    <td><img class="rounded" style="height: 70px" src="${item.categoryImg}" alt="image"/></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <button class="dropdown-item table-show-btn" href="javascript:void(0);" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bx bx-show me-1"></i> View</button>
                                <button class="dropdown-item table-edit-btn" data-id="${item.id}" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#createModal" ><i class="bx bx-edit-alt me-1" ></i> Edit</button>
                                <button class="dropdown-item table-delete-btn" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bx bx-trash me-1"></i> Delete</button>
                            </div>
                        </div>
                    </td>
                </tr>
            `)
        }

        function showData(selector, data){
            $(selector).empty();
            $(selector).append(`
                <tr>
                    <th>Name EN</th>
                    <th>:</th>
                    <td>
                        ${data.categoryName}
                    </td>
                </tr>
                <tr>
                    <th>Name BN</th>
                    <th>:</th>
                    <td>
                        ${data.categoryName_bn}
                    </td>
                </tr>
                <tr>
                    <th>Details En</th>
                    <th>:</th>
                    <td>
                        ${data.categoryDetails}
                    </td>
                </tr>
                <tr>
                    <th>Details BN</th>
                    <th>:</th>
                    <td>
                        ${data.categoryDetails_bn}
                    </td>
                </tr>
                <tr>
                    <th>Item Total</th>
                    <th>:</th>
                    <td>
                        ${data.itemTotal}
                    </td>
                </tr>
                <tr>
                    <th>Item Total</th>
                    <th>:</th>
                    <td>
                        <img src="${data.categoryImg}" height="150px">
                    </td>
                </tr>

            `)
        }


    </script>
@endsection
