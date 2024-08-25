<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRM - Đăng nhập</title>
    <link href="{{asset('assets/img/icon.ico')}}" rel="icon">
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.esc.js') }}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</head>
<style>
    .login-section {
        background-color: #e0f7fa;
        padding: 3rem 0;
    }

    .login-card {
        border: 1px solid #e9ecef;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .login-card-body {
        padding: 2rem;
    }

    .login-card img {
        width: 175px;
        height: 57px;
        margin-bottom: 1rem;
    }

    .login-card h4 {
        font-size: 1rem;
        font-weight: 400;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    .form-floating .form-control {
        border-radius: 0.25rem;
    }

    .form-floating label {
        padding-left: 1.5rem;
    }

    .form-check-label {
        color: #6c757d;
    }

    .forgot-password, .sign-up-link {
        color: #0d6efd;
        text-decoration: none;
    }

    .forgot-password:hover, .sign-up-link:hover {
        text-decoration: underline;
    }

    .btn-primary {
        padding: 0.75rem;
        font-size: 1rem;
    }

    .text-center p {
        margin-bottom: 0;
    }
</style>
<body>
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <div class="card login-card">
                    <div class="card-body login-card-body text-center">
                        <img src="assets/img/icon.ico" alt="Logo" style="width: 80px">
                        <h3 class="fw-normal">Đăng nhập</h3>
                        <form action="{{route('post-login')}}" method="post" id="login-form">
                            {{ csrf_field() }}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required>
                                <label for="username">Tên đăng nhập</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input id="pwd-input" type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                                <label for="pwd-input">Mật khẩu</label>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="showPwdCheckbox">
                                    <label class="form-check-label" for="showPwdCheckbox">
                                        Hiển thị mật khẩu
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </div>
                            @if(Session::has('msg'))
                                <div class="alert alert-danger" role="alert">
                                    <p class="m-0">
                                        <i class="bi bi-exclamation-diamond"></i>
                                        {!! Session::get('msg') !!}
                                    </p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<script>
    const pwdInput = document.getElementById('pwd-input')
    const showPwdCheckbox = document.getElementById('showPwdCheckbox')
    showPwdCheckbox.addEventListener('change', function () {
        if (this.checked) {
            pwdInput.type = 'text';
        } else {
            pwdInput.type = 'password';
        }
    });
</script>
</html>
