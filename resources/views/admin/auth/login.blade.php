<!DOCTYPE html>
<html
    lang="{{app()->getLocale() == "en" ? 'en' : 'ar'}}"
    dir="{{app()->getLocale() == "en" ? 'ltr' : 'rtl'}}"
    class="{{session('theme') == "light" ? 'light-style' : 'dark-style'}} layout-menu-fixed"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template"
>
<head>
    @include('layout.header')
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset("assets/vendor/css/pages/page-auth.css")}}" />
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img height="80px" src="{{asset('assets/logo.svg')}}"/>
                    </div>
                    <h4 class="mb-2 text-center">Welcome to Captain Binary 👋</h4>
                    <p class="mb-4 text-center">Please sign-in to your account and start the adventure</p>



                    <form id="formAuthentication" class="mb-3" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label"> Email Address </label>
                            <input
                                value=""
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email or username"
{{--                                autofocus--}}
{{--                                required--}}
                            />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                {{--<a href="auth-forgot-password-basic.html">
                                    <small>Forgot Password?</small>
                                </a>--}}
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    value=""
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                    required
                                />
                                <span class="input-group-text cursor-pointer" id="showPassword"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input @if(\Illuminate\Support\Facades\Cookie::get('remember') == "on") checked @endif name="remember" class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me  </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign In</button>
                        </div>
                    </form>

                    {{--<p class="text-center">
                        <span>New on our platform?</span>
                        <a href="auth-register-basic.html">
                            <span>Create an account</span>
                        </a>
                    </p>--}}
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<script>

    $('#formAuthentication').on('click', function (e){
        e.preventDefault();
        let email = $(this).find('input[name=email]');
        let password = $(this).find('input[name=password]');
        let form_data = new FormData();
        form_data.set('email', email.val());
        form_data.set('password', password.val());
        requestData({
            url: '/login',
            method: 'POST',
            data: form_data
        }).then(function (response){
            if(response.status === 200){
                let data = response.data.data;
                setLogin(true);
                saveUser(data)
                window.location.href = getWebURL()
            }
        }).catch(function (error){
            console.log(error)
        })

    })

    $('#showPassword').on('click', function (){
        let type = $('#password').attr('type');
        $('#password').attr('type', type == "text" ? "password" : "text")
    })
</script>
</body>
</html>
