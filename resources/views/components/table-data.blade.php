<div class="table-responsive position-relative text-nowrap">
    <div class="loading-progressbar">
        <div class="progress" style="height: 2px">
            <div class="progress-bar rounded-0 progress-bar-striped progress-bar-animated bg-primary table-progress-bar" role="progressbar" style="width: 10%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="h-100 w-100 position-absolute bg-transparent" style="left: 0; top: 0">

        </div>
    </div>
    <table class="table">
        <thead>
            {{$slot}}
        </thead>
        <tbody id="table-contents" class="table-border-bottom-0">

        </tbody>
    </table>
</div>

<div class="m-3">
    <div class="btn-group btn-group-sm" role="group" id="paginations" aria-label="Basic example">

    </div>
</div>

<script>
    let progress_start = 0;
    let interval = setInterval(() => {
        if (progress_start >= 100) {
            progress_start = 0; // Reset to 0% after reaching 100%
        }
        progress_start += 5; // Increment by 20% every second

        // Update the width of the progress bar
        $('.table-progress-bar').css({
            width: progress_start + '%' // Ensure percentage is included
        });
    }, 250); // 1000ms = 1 second


    $('#paginations').on('click', '.pagination-link', function (){
        let request_data = $(this).attr('url');
        let params = {};
        if(request_data){
            request_data.split('&').forEach(function (segment){
                let segment_divide = segment.split('=');
                let params_key = segment_divide[0];
                params[params_key] = segment_divide[1];
            });

            //objectToParamsPush() method in header component
            objectToParamsPush(params)

            //Get Data Function In View File
            getData()
        }
    })


    function appendPaginateButton(selector,link){
        let request_data = link.url ? link.url.split('?') : [];
        let url_page = getUrlParams().page;
        let link_page = getUrlParams(link.url ?? 'abc').page
        if(request_data.length === 2){
            request_data = request_data[1]
        }
        else{
            request_data = ''
        }

        $(selector).append(`
                 <button url="${request_data}" type="button" class="btn ${url_page === link_page ? 'active' : ''} pagination-link btn-outline-primary">${link.label}</button>
            `)
    }

    $('#table-contents').on('click', '.table-delete-btn', function (){
        let id = $(this).attr('data-id');
        $('#modal-delete-button').attr('data-id', id);
    })
</script>
