<div class="modal" id="viewModal">
    <div class="modal-dialog {{$attributes->get('size')}}">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5>{{$attributes->get('title')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <hr class="mt-0">

            <!-- Modal body -->
            <div class="modal-body">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
