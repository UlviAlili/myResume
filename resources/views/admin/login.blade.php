<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset("assets/vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/css/vendor.bundle.base.css")}}">
    <!-- end-inject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- end-inject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset('assets/sweet-alert/sweetalert2.min.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset("assets/images/favicon.png")}}" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        <form action="{{route('login')}}" method="POST" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control p_input" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control p_input">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="form-check">
                                    <label for="remember" class="form-check-label">
                                        <input type="checkbox" id="remember" class="form-check-input"> Remember me </label>
                                </div>
                                {{--                                <a href="#" class="forgot-pass">Forgot password</a>--}}
                            </div>
                            <div class="text-center">
                                <button type="button" id="btnLogin" class="btn btn-primary btn-block enter-btn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset("assets/vendors/js/vendor.bundle.base.js")}}"></script>
<!-- end-inject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset("assets/js/off-canvas.js")}}"></script>
<script src="{{asset("assets/js/hoverable-collapse.js")}}"></script>
<script src="{{asset("assets/js/misc.js")}}"></script>
<script src="{{asset("assets/js/settings.js")}}"></script>
<script src="{{asset("assets/js/todolist.js")}}"></script>
<script src="{{asset("assets/sweet-alert/sweetalert2.all.min.js")}}"></script>
<script>
    $('#btnLogin').click(function () {
        let email = document.querySelector("#email").value;
        let password = document.querySelector("#password").value;

        if (email.trim() === '') {
            Swal.fire({
                icon: 'info',
                title: 'Warning!',
                text: "Email can't be empty",
            })
        } else if (!emailControl(email)) {
            Swal.fire({
                icon: 'info',
                title: 'Warning!',
                text: "Enter a valid Email",
            })
        } else if (password.trim() === '') {
            Swal.fire({
                icon: 'info',
                title: 'Warning!',
                text: "Password can't be empty",
            })
        } else {
            $("#loginForm").submit();
        }
    });

    function emailControl(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>
<!-- end-inject -->
</body>
</html>
