<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset("assets/vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/css/vendor.bundle.base.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/@fortawesome/fontawesome-free/css/all.css")}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset("assets/images/favicon.ico")}}" />
    <link rel="stylesheet" href="{{asset('assets/sweet-alert/sweetalert2.min.css')}}">
    @yield("css")
</head>
<body>
<div class="container-scroller">
    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo text-decoration-none" href="{{ route('admin.index') }}">
                <p class="text-white h2 mt-2 font-weight-normal" style="letter-spacing: 6px;">RESUME</p>
            </a>
            <a class="sidebar-brand brand-logo-mini text-decoration-none" href="{{route("admin.index")}}">
                <p class="text-white h2 mt-2 font-weight-normal">R</p>
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="{{asset("assets/images/faces/Ulvi.jpg")}}" alt="">
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal">{{auth()->user()->name}}</h5>
                        </div>
                    </div>
                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-primary"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-onepassword  text-info"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-calendar-today text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.index') ? "active" : ""}}">
                <a class="nav-link" href="{{route("admin.index")}}">
                    <span class="menu-icon">
                         <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.profile.index') ? "active" : ""}}">
                <a class="nav-link" href="{{route('admin.profile.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-information-variant"></i>
                    </span>
                    <span class="menu-title">Profile</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.social.index') ? "active" : ""}} {{Route::is('admin.social.create') ? "active" : ""}}">
                <a class="nav-link" href="{{route('admin.social.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-link"></i>
                    </span>
                    <span class="menu-title">Social Links</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.language.index') ? "active" : ""}} {{Route::is('admin.language.create') ? "active" : ""}}">
                <a class="nav-link" href="{{route('admin.language.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-link"></i>
                    </span>
                    <span class="menu-title">Languages</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.interest.index') ? "active" : ""}} {{Route::is('admin.interest.create') ? "active" : ""}}">
                <a class="nav-link" href="{{route('admin.interest.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-link"></i>
                    </span>
                    <span class="menu-title">Interests</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.skills.index') ? "active" : ""}} {{Route::is('admin.skills.create') ? "active" : ""}}">
                <a class="nav-link" href="{{route('admin.skills.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-lead-pencil"></i>
                    </span>
                    <span class="menu-title">Skills</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.education.index') ? "active" : ""}} {{Route::is('admin.education.create') ? "active" : ""}}">
                <a class="nav-link" href="{{route("admin.education.index")}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">Education</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.experience.index') ? "active" : ""}} {{Route::is('admin.experience.create') ? "active" : ""}}">
                <a class="nav-link" href="{{route("admin.experience.index")}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Experience</span>
                </a>
            </li>
            <li class="nav-item menu-items {{Route::is('admin.portfolio.index') ? "active" : ""}} {{Route::is('admin.portfolio.create') ? "active" : ""}} {{Route::is('admin.portfolio.edit') ? "active" : ""}} {{Route::is('admin.portfolio.images') ? "active" : ""}}">
                <a class="nav-link" href="{{route('admin.portfolio.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document-box"></i>
                    </span>
                    <span class="menu-title">Portfolio</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="#">
                    <span class="menu-icon">
                        <i class="mdi mdi-chart-bar"></i>
                    </span>
                    <span class="menu-title">Projects</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="#">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Certificates</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="{{asset("index.html")}}"><img src="{{asset("assets/images/logo-mini.svg")}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                            <div class="navbar-profile">
                                <img class="img-xs rounded-circle" src="{{asset("assets/images/faces/Ulvi.jpg")}}" alt="">
                                <p class="mb-0 d-none d-sm-block navbar-profile-name">{{auth()->user()->name}}</p>
                                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                            <h6 class="p-3 mb-0">Profile</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-settings text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Settings</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </button>
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield("content")
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date('Y')}}</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset("assets/vendors/js/vendor.bundle.base.js")}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset("assets/js/off-canvas.js")}}"></script>
<script src="{{asset("assets/js/hoverable-collapse.js")}}"></script>
<script src="{{asset("assets/js/misc.js")}}"></script>
<script src="{{asset("assets/js/settings.js")}}"></script>
<script src="{{asset("assets/js/todolist.js")}}"></script>
<script src="{{asset("assets/sweet-alert/sweetalert2.all.min.js")}}"></script>
@include('sweetalert::alert')
@yield("js")
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
</body>
</html>
