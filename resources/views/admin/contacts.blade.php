@extends('layout.main')
@section('content')
    <div class="card">
        <h5 class="card-header">Contact List</h5>
        <hr class="mt-0">
        <x-table-search-form/>
        <x-table-data>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </x-table-data>
        <x-delete-modal/>
        <x-view-modal size="modal-lg" title="Show Contacts">
            <table class="table" >
                <thead id="show-data">

                </thead>
            </table>
        </x-view-modal>
    </div>

    <script>


        getData()
        function getData(params = getUrlParams()){
            progressBarON();
            requestData.get('/contact', {
                method: 'get',
                params: params
            })
            .then(function (response){
                if (response.status === 200){
                    progressBarOFF();
                    let response_data = response.data.data;
                    //Cards Data Count
                    $('#table-contents').empty();
                    $('#paginations').empty();
                    let index = response_data.per_page * (response_data.current_page -1)
                    response_data.data.forEach(function (item){
                        appendRow('#table-contents', item, ++index)
                    })


                    if(response_data.links.length > 3){
                        response_data.links.forEach(function (link){
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
        deleteData('/contact/delete/:id')


        //Show Data
        $('#table-contents').on('click', '.table-show-btn', function (){
            let id = $(this).attr('data-id');
            requestData('/contact/show/'+id, {
                method: 'GET'
            }).then(function (response){
                console.log(response.data)
                let data = response.data.data;
                showData('#show-data', data)

            }).catch(function (error){

            })
        });

        //Change Status
        $('#table-contents').on('click', '.table-change-status-btn', function (){
            let id = $(this).attr('data-id');
            let status = $(this).attr('data-status');
            requestData('/contact/changeStatus/'+id, {
                method: 'GET',
                params: {
                    status : status
                }
            }).then(function (response){
                let data = response.data.data;
                getData()

            }).catch(function (error){

            })
        });

        function appendRow(selector,item, index = 1){
            $(selector).append(`
                 <tr>
                    <td><strong>${index}</strong></td>
                    <td><strong>${item.name}</strong></td>
                    <td>${item.mobile}</td>
                    <td>${printWithLimit(item.email, 10)}</td>
                    <td>${printWithLimit(item.msg, 15)}</td>

                    <td><span class="badge ${item.status === 'pending' ? 'bg-label-primary' : 'bg-label-danger' } me-1">${item.status}</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <button class="dropdown-item table-show-btn" href="javascript:void(0);" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bx bx-show me-1"></i> View</button>
                                <button class="dropdown-item table-change-status-btn" data-status="${item.status === "solved" ? 'pending' : 'solved'}" data-id="${item.id}" href="javascript:void(0);" ><i class="bx bx-checkbox-minus me-1"></i> ${item.status === "solved" ? 'Pending' : 'Solved'}</button>
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
                    <th>name</th>
                    <th>:</th>
                    <td>
                        ${data.name}
                    </td>
                </tr>
                <tr>
                    <th>email</th>
                    <th>:</th>
                    <td>
                        ${data.email}
                    </td>
                </tr>
                <tr>
                    <th>mobile</th>
                    <th>:</th>
                    <td>
                        ${data.mobile}
                    </td>
                </tr>
                <tr>
                    <th>message</th>
                    <th>:</th>
                    <td>
                        ${data.msg}
                    </td>
                </tr>
                <tr>
                    <th>status</th>
                    <th>:</th>
                    <td>
                        ${data.status}
                    </td>
                </tr>
            `)
        }


    </script>
@endsection

