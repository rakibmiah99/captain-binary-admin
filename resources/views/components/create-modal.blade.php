<div class="modal" id="createModal">
    <div class="modal-dialog {{$attributes->get('size') }}">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5>{{$attributes->get('title')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <hr class="mt-0">

            <!-- Modal body -->
            <div class="modal-body position-relative">
                <div style="top: 0;left: 0" class="position-absolute modal-loader d-flex justify-content-center align-items-center bg-white h-100 w-100">
                    <div class="spinner-border spinner-border-lg text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                {{$slot}}
            </div>
        </div>
    </div>
</div>
