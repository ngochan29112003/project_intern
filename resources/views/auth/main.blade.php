<?php

use App\StaticString;

$token = 'position';
?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Human Resource Management</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ======= Các thư viện khác thì dán vào đây ======= -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- ======= CSS thì dán vào đây ======= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @yield('head')
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <img src="{{asset('assets/img/logo.png')}}" alt="">
            <span class="d-none d-lg-block">HRM</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Sit rerum fuga</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>2 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Dicta reprehenderit</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="" alt="Profile" class="rounded-circle">
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2">{{\Illuminate\Support\Facades\Request::session()->get(App\StaticString::ACCOUNT_ID)}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>Ngoc Han</h6>
                        <span>Web Designer</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </nav>
</header>


<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('index-dashboard')}}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#account-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-fill-gear"></i></i><span>Account</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="account-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('index-account')}}">
                        <i class="bi bi-circle"></i><span>Account list</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#employee-nav" data-bs-toggle="collapse" href="#"
               aria-expanded="false">
                <i class="bi bi-person-fill"></i><span>Employee</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="employee-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{route('index-employees')}}">
                        <i class="bi bi-circle"></i><span>Employee list</span>
                    </a>
                </li>
            </ul>
            <ul id="employee-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Reward</span>
                    </a>
                </li>
            </ul>
            <ul id="employee-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{route('index-discipline')}}">
                        <i class="bi bi-circle"></i><span>Discipline</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#department-nav" data-bs-toggle="collapse" href="#"
               aria-expanded="false">
                <i class="bi bi-building-fill"></i><span>Department</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="department-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{route('index-department')}}">
                        <i class="bi bi-circle"></i><span>Department list</span>
                    </a>
                </li>
            </ul>
        </li>

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" data-bs-target="#khachhang-nav" data-bs-toggle="collapse" href="#"--}}
{{--               aria-expanded="false">--}}
{{--                <i class="bi bi-person-check-fill"></i></i><span>Customer management</span><i--}}
{{--                    class="bi bi-chevron-down ms-auto"></i>--}}
{{--            </a>--}}
{{--            <ul id="khachhang-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">--}}
{{--                <li>--}}
{{--                    <a href="{{route('index-customer')}}">--}}
{{--                        <i class="bi bi-circle"></i><span>Customer list</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#project-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar2"></i><span>Project</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="project-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Project list</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#permission-nav" data-bs-toggle="collapse" href="#"
               aria-expanded="false">
                <i class="bi bi-key"></i><span>Permission</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="permission-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Permission list</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#payroll-nav" data-bs-toggle="collapse" href="#"
               aria-expanded="false">
                <i class="bi bi-bank"></i><span>Payroll</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="payroll-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Payroll list</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#position-nav" data-bs-toggle="collapse" href="#"
               aria-expanded="false">
                <i class="bi bi-clipboard2-fill"></i><span>Position</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="position-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>List of positions</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#task-nav" data-bs-toggle="collapse" href="#"
               aria-expanded="false">
                <i class="bi bi-book-fill"></i><span>Task</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="task-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Task list</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside>

<main id="main" class="main">
    @yield('contents')
</main>
</body>
<!-- ======= JS thì dán vào đây ======= -->
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('assets/vendor/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('assets/js/datatables.js')}}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
@yield('scripts')

