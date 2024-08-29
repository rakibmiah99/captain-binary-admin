<meta charset="utf-8" />
<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
/>

<title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

<meta name="description" content="" />

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{asset("assets/img/favicon/favicon.ico")}}" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
/>

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="{{asset("assets/vendor/fonts/boxicons.css")}}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Core CSS -->
<link rel="stylesheet" href="{{asset("assets/vendor/css/core.css")}}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{asset("assets/vendor/css/theme-default.css")}}" class="template-customizer-theme-css" />
@if(session('theme') == "dark")
    <link rel="stylesheet" href="{{asset("assets/vendor/css/core.dark.css")}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset("assets/vendor/css/theme-default.dark.css")}}" class="template-customizer-theme-css" />
@endif
<link rel="stylesheet" href="{{asset("assets/vendor/css/api.css")}}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{asset("assets/css/demo.css")}}" />
<link rel="stylesheet" href="{{asset("assets/css/style.css")}}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css")}}" />

<link rel="stylesheet" href="{{asset("assets/vendor/libs/apex-charts/apex-charts.css")}}" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- Page CSS -->

<!-- Helpers -->
<script src="{{asset("assets/vendor/js/helpers.js")}}"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{asset("assets/js/config.js")}}"></script>

<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset("assets/vendor/libs/jquery/jquery.js")}}"></script>
<script src="{{asset("assets/vendor/libs/popper/popper.js")}}"></script>
<script src="{{asset("assets/vendor/js/bootstrap.js")}}"></script>
<script src="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>

<!-- Vendors JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="{{asset("assets/vendor/libs/apex-charts/apexcharts.js")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js'></script>

<!-- CodeMirror CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.6/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.6/theme/default.min.css"> <!-- or another light theme like 'eclipse' -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.6/theme/dracula.min.css">

<!-- Highlight.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">

<!-- Highlight.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>

<!-- Optional: load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/python.min.js"></script>

<!-- CodeMirror JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.6/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.6/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.6/addon/edit/matchbrackets.min.js"></script>




<style>
    .CodeMirror {
        border: 1px solid #ddd;
        height: 200px;
    }
    .toolbar{
        display: none;
    }
</style>


<script>
    const BASE_URL = '{{env('APP_URL')}}'
    function getWebURL(end_point = ""){
        return BASE_URL+end_point;
    }


    const requestData = axios.create({
        baseURL: BASE_URL+'/admin',
        timeout: 1000,
        headers: {
            'Authorization': 'Bearer '+getUser()?.token,
        }
    })


    function printWithLimit(key, length) {
        return key.slice(0,length)+(key.length > length ? '...' : '')
    }



    function Toast(message, type = 'success'){
        let options = {
            text: message,
            className: "info",
            style: {
                color: 'white'
            },
            gravity: 'bottom'
        }


        if(type === "success"){
            options.style.background = "#2D9596";
        }
        else if(type === "error"){
            options.style.background = "#EE4E4E";
        }

        Toastify(options).showToast();
    }


    $(document).ready(function (){
        @if(session('success'))
        var toastMessage =" @php echo session('success'); @endphp";
        Toast(toastMessage);
        @elseif(session('error'))
        var toastMessage =" @php echo session('error'); @endphp";
        Toast(toastMessage, 'error');
        @endif
    })


    function modalLoaderON(){
        $('.modal-loader').removeClass('d-none')
    }

    function modalLoaderOFF(){
        $('.modal-loader').addClass('d-none')
    }

    function saveButtonLoaderON(){
        $('.save-loading-btn').removeClass('d-none')
        $('.save-btn').addClass('d-none')
    }

    function saveButtonLoaderOFF(){
        $('.save-loading-btn').addClass('d-none')
        $('.save-btn').removeClass('d-none')
    }

    function progressBarON(){
        $('.loading-progressbar').removeClass('d-none')
    }

    function progressBarOFF(){
        $('.loading-progressbar').addClass('d-none')
    }


    function getUrlParams(url = null){
        let params = {};
        let search_data = url ?? window.location.search;
        let request_data = search_data.split('?');

        request_data.length === 2 ? request_data = request_data[1] : request_data = '';
        request_data.split('&').forEach(function (segment){
            let segment_divide = segment.split('=');
            let params_key = segment_divide[0];
            if(params_key){
                params[params_key] = segment_divide[1];
            }
        });
        return params;
    }

    function objectToParamsPush(params){
        let url = new URL(window.location.href)
        // Add each parameter to the URL
        for (let key in params) {
            url.searchParams.set(key, params[key]);
        }

        // Update the browser URL without reloading the page
        window.history.pushState({}, '', url);
    }

    function codeMirror(id, options = {}, auto_height = false){
        // Initialize CodeMirror

        let default_configure = {
            mode: 'javascript',
            theme: "{{session('theme') == \App\Enums\Theme::DARK->value ? 'dracula' : 'default'}}",
            lineNumbers: false,
            matchBrackets: true
        }

        let editor = CodeMirror.fromTextArea(document.getElementById(id), {...default_configure, ...options});
        if(auto_height){
            adjustCodeMirrorHeight(editor);
        }
        return editor;
    }

    function adjustCodeMirrorHeight(editor, default_size = "auto") {
        editor.setSize(null, default_size);
        const height = editor.getScrollInfo().height+30;
        editor.setSize(null, height + 'px');
    }


    function fileToLoadPDF(file_id, iframe_id){
        let file = document.getElementById(file_id).files[0];
        let iframe = document.getElementById(iframe_id);
        if (file && file.type === 'application/pdf') {
            var fileURL = URL.createObjectURL(file);
            iframe.src = fileURL;
        } else {
            // Toast('Please select a valid PDF file.', 'error');
        }
    }


    function setLogin(value){
        if (value === true){
            sessionStorage.setItem('is-login', 'true');
        }
        else{
            sessionStorage.setItem('is-login', 'false');
        }
    }

    function checkLogin(){
        let is_login = sessionStorage.getItem('is-login');
        if(is_login === 'true'){
            return true;
        }
        else{
            return false;
        }
    }

    function saveUser(data){
        data = JSON.stringify(data)
        const encryptedData = CryptoJS.AES.encrypt(data, 'secretKey').toString();
        sessionStorage.setItem('user',encryptedData);
    }

    function getUser(){
        let user_data = sessionStorage.getItem('user');
        if(user_data){
            const decryptedDataBytes = CryptoJS.AES.decrypt(user_data, 'secretKey');
            const decryptedData = decryptedDataBytes.toString(CryptoJS.enc.Utf8);
            return JSON.parse(decryptedData);
        }
        else{
            return {};
        }

    }

    function removeUser() {
        sessionStorage.removeItem('user');
    }

    if(!checkLogin()){
        console.log('hello')
        let url = window.location.href.split('?');
        if (url[0] !== getWebURL('/login')){
            window.location.href = getWebURL('/login');
        }

    }

</script>
