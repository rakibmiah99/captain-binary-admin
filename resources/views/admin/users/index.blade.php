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
                <th>Name</th>
                <th>Email</th>
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
        @include('admin.users.create')
    </div>

    <script>
        getData()
        function getData(params = getUrlParams()){
            progressBarON();
            requestData.get('/users', {
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
        deleteData('/users/delete/:id')


        //Show Data
        $('#table-contents').on('click', '.table-show-btn', function (){
            let id = $(this).attr('data-id');
            requestData('/users/show/'+id, {
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
            setFormUrl('/users/update/'+id, 'edit');
            modalLoaderON()
            requestData('/users/show/'+id, {
                method: 'GET'
            }).then(function (response){
                let data = response.data.data;
                setFormData(data.name, data.email);
                modalLoaderOFF();
            }).catch(function (error){

            });
        });


        $('.create-btn').on('click', () => {
            modalLoaderOFF();
            setFormUrl('/users/store')
        })


        function setFormData(name= "", email = "",){
            let createForm = $('.create-form');
            createForm.find('input[name=name]').val(name)
            createForm.find('input[name=email]').val(email)
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
                    <td><strong>${printWithLimit(item.name, 15)}</strong></td>
                    <td>${printWithLimit(item.email, 30)}</td>
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
                    <th>Name</th>
                    <th>:</th>
                    <td>
                        ${data.name}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>:</th>
                    <td>
                        ${data.email}
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <th>:</th>
                    <td>
                        ${data.created_at}
                    </td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <th>:</th>
                    <td>
                        ${data.updated_at}
                    </td>
                </tr>

            `)
        }


    </script>
@endsection

