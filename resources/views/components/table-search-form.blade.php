<form class="d-flex px-3 mb-2 justify-content-between" id="search-form">
    <div class="d-flex align-items-center">
        <select name="perpage" style="width: 150px" class="form-select form-select-sm">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
        </select>


    </div>

    <!-- searchData function in main layout script -->
    <input value="" name="q" style="width: 150px" id="searchInput" class="form-control d-inline form-control-sm" type="text" placeholder="Search">



</form>

<script>
    //Search PerPage
    $('select[name="perpage"]').on('change', function (){
        let form_data = $('#search-form').serialize();
        form_data = '?'+form_data;
        let params = getUrlParams(form_data);
        objectToParamsPush(params);
        //Get Data Function In View File
        getData()
    })


    let q_timeout = null;
    //Search By Input
    $('input[name="q"]').on('keyup', function (){
        clearTimeout(q_timeout);
        q_timeout = setTimeout(function (){
            let form_data = $('#search-form').serialize();
            form_data = '?'+form_data;
            //getUrlParams() and objectToParamsPush() method in header component
            let params = getUrlParams(form_data);
            objectToParamsPush(params);

            //Get Data Function In View File
            getData()
        }, 500);

    })
</script>
