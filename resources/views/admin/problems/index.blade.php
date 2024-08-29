@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0">Problem List</h5>
            <button class="btn btn-sm btn-primary create-btn" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
        </div>

        <hr class="mt-0">
        <x-table-search-form/>
        <x-table-data>
            <tr>
                <th>sl</th>
                <th>Title</th>
                <th>Title In Bangla</th>
                <th>Difficulty</th>
                <th>Point</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
        </x-table-data>
        <x-delete-modal/>
        <x-view-modal size="modal-xl" title="Show Problem">
            <table class="table" >
                <thead id="show-data">

                </thead>
            </table>
        </x-view-modal>
        @include('admin.problems.create')
    </div>

    <script>
        getData()
        function getData(params = getUrlParams()){
            progressBarON();
            requestData.get('/problem', {
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
        deleteData('/problem/delete/:id')


        //Show Data
        $('#table-contents').on('click', '.table-show-btn', function (){
            let id = $(this).attr('data-id');
            requestData('/problem/show/'+id, {
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
            formInitialStep()
            let id = $(this).attr('data-id');
            setFormUrl('/problem/update/'+id, 'edit');
            modalLoaderON()
            requestData('/problem/show/'+id, {
                method: 'GET'
            }).then(function (response){
                let data = response.data.data;
                setFormData(data);
                modalLoaderOFF();
            }).catch(function (error){

            });
        });


        $('.create-btn').on('click', () => {
            formInitialStep()
            modalLoaderOFF();
            setFormUrl('/problem/store');
        })

        function formInitialStep(){
            currentStep = 1;
            $('#step1').addClass('form-step-active');
            $('#step2').removeClass('form-step-active');
            $('#step3').removeClass('form-step-active');
        }


        function setFormData(data = {}){
            let createForm = $('.create-form');
            var ref_area = $('#reference-area');
            createForm.find('input[name=title_bn]').val(data.title_bn ?? '')
            createForm.find('input[name=title]').val(data.title ?? '')
            createForm.find('select[name=difficulty]').val(data.difficulty ?? '')
            createForm.find('input[name=point]').val(data.point ?? '')
            createForm.find('input[name=tags]').val(data.tags ?? '')
            createForm.find('select[name=category_id]').val(data.category_id ?? '')
            createForm.find('textarea[name=description_bn]').text(data.description_bn ?? '')
            createForm.find('textarea[name=description]').text(data.description ?? '')
            if (data.references && data.references.length > 0){
                let is_ref_area_empty = false;
                data.references.forEach(function (ref_item, index){
                    var ref_element = ref_area.children().first().clone();
                    if(is_ref_area_empty === false){
                        ref_area.empty();
                        is_ref_area_empty = true;
                    }
                    var ref_element_inputs = ref_element.find('input');
                    for(let i = 0; i < ref_element_inputs.length ; i++){
                        ref_element_inputs.eq(i).val("")
                    }

                    ref_element.find('.reference_title').val(ref_item.reference_title)
                    ref_element.find('.reference_link').val(ref_item.reference_link)
                    ref_area.append(ref_element)
                })
            }
            else{
                var ref_element = ref_area.children().first().clone();
                var ref_element_inputs = ref_element.find('input');
                for(let i = 0; i < ref_element_inputs.length ; i++){
                    ref_element_inputs.eq(i).val("")
                }
                ref_area.empty();
                ref_area.append(ref_element)
            }

            code.getDoc().setValue(data.details?.code ?? "//write code here")
            test_case.getDoc().setValue(data.details?.test_case ?? "//write code here")
        }


        function setFormUrl(url, form_mode = 'create'){
            let createForm = $('.create-form');
            let instruction_bn_wrapper = createForm.find('input[name=instructions_bn]').parent().parent();
            if(createForm.attr('form-mode') === "edit" && form_mode === "create"){
                setFormData()
            }

            if(form_mode === 'create'){
                instruction_bn_wrapper.find('.asterisk').removeClass('d-none');
                instruction_bn_wrapper.find('input').attr('required', true)
            }
            else{
                instruction_bn_wrapper.find('.asterisk').addClass('d-none')
                instruction_bn_wrapper.find('input').attr('required', false)
            }

            createForm.attr('form-mode', form_mode)
            createForm.attr('action', url)
        }

        function appendRow(selector,item, index = 1){
            $(selector).append(`
                 <tr>
                    <td><strong>${index}</strong></td>
                    <td>${printWithLimit(item.title, 15)}</td>
                    <td>${printWithLimit(item.title_bn, 15)}</td>
                    <td>${item.difficulty}</td>
                    <td>${item.point}</td>
                    <td>${item.tags}</td>
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
            let template = `
                <tr>
                    <th>Title</th>
                    <th>:</th>
                    <td>
                        ${data.title}
                    </td>
                </tr>

                <tr>
                    <th>Title In Bangla</th>
                    <th>:</th>
                    <td>
                         ${data.title_bn}
                    </td>
                </tr>

                <tr>
                    <th>description</th>
                    <th>:</th>
                    <td>
                         ${data.description}
                    </td>
                </tr>

                <tr>
                    <th>description In Bangla</th>
                    <th>:</th>
                    <td>
                         ${data.description_bn}
                    </td>
                </tr>

                <tr>
                    <th>Difficulty</th>
                    <th>:</th>
                    <td>
                         ${data.difficulty}
                    </td>
                </tr>

                <tr>
                    <th>Point</th>
                    <th>:</th>
                    <td>
                         ${data.point}
                    </td>
                </tr>

                <tr>
                    <th>Tags</th>
                    <th>:</th>
                    <td>
                         ${data.tags}
                    </td>
                </tr>

                <tr>
                    <th>References</th>
                    <th>:</th>
                    <td>`;

            data.references.forEach(function(ref_item){
                template+= `<p class="mb-0"><b>${ref_item.reference_title}: </b> ${ref_item.reference_link}</p>`;
            })
              template+=`</td>
                </tr>

                <tr>
                    <th>Instruction In English</th>
                    <th>:</th>
                    <td>
                        <iframe src="${data.details?.instructions}" style="width: 100%; height: 300px" id="view_instructions"></iframe>
                    </td>
                </tr>

                <tr>
                    <th>Instruction In Bangla</th>
                    <th>:</th>
                    <td>
                        <iframe src="${data.details?.instructions_bn}" style="width: 100%; height: 300px" id="view_instructions_bn"></iframe>
                    </td>
                </tr>

                <tr>
                    <th>code</th>
                    <th>:</th>
                    <td>
                        <textarea id="view_code">${data.details?.code}</textarea>
                    </td>
                </tr>

                <tr>
                    <th>Test Case</th>
                    <th>:</th>
                    <td>
                        <textarea id="view_test_case" >${data.details?.test_case}</textarea>
                    </td>
                </tr>

            `


            $(selector).append(template)

            var v_code = codeMirror('view_code', {readOnly: true}, true);
            var v_test_case = codeMirror('view_test_case', {readOnly: true}, true);
        }


    </script>
@endsection
