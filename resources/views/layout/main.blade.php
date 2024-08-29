@php
    $title = 'Captain Binary|Admin';
@endphp

<!DOCTYPE html>
<html
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template"
>
<head>
    <title>{{$title}} </title>
    @include('layout.header')
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('layout.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('layout.navbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
{{--    <x-delete-modal/>--}}
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

@include('layout.footer_script')
<script>
    let timeout = null;
    function searchData(){
        clearTimeout(timeout);
        timeout = setTimeout(function (){
            $('#search-form').trigger('submit');
        }, 500)
    }


    $(document).ready(function() {
        $('.select-2').select2();
    });



    //delete modal from index list button
    $('.delete-btn').on('click', function (){
        let url = $(this).attr('url')
        $('#modal-delete-form').attr('action', url)
    })
</script>
</body>
</html>
