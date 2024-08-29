<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h1 class="text-center">Are you sure?</h1>
                <p class="text-center">Once you delete, You can not recover this data and related files.</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer flex justify-content-center">
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="modal-delete-button"  data-bs-dismiss="modal">Delete</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function deleteData(endpoint){
        $('#modal-delete-button').on('click', function (){
            let id = $(this).attr('data-id');
            requestData(endpoint.replace(':id', id), {
                method: 'POST'
            }).then(function (response){
                getData();
            }).catch(function (error){
                console.log(error)
                // getData()
            })
        })
    }
</script>
