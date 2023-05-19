<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" id="msg">{{ Session::get('error') }}</div>
                            {{ Session::forget('error') }}
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success" id="msg">{{ Session::get('success') }}</div>
                            {{ Session::forget('success') }}
                        @endif
                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome Admin</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('img/avatars/avatar.jpg') }}" alt="Charles Hall"
                                            alt="Charles Hall" class="img-fluid rounded-circle" width="132"
                                            height="132" />
                                    </div>
                                </div>
                                </form>
                                <form id="reset-password-form" method="POST" class="login-form"
                                    action="{{ route('password.reset.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $data['token'] }}">
                                    <input type="hidden" name="email" class="form-control"
                                        value="{{ $data['email'] ?? old('email') }}" readonly>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password"
                                            placeholder="Enter your password" required />

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input class="form-control form-control-lg" type="password"
                                            name="password_confirmation" placeholder="Enter your password" />

                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("#msg").fadeOut(3000);
            });

        });
    </script>
</body>

</html>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Password reset</title>
</head>

<body>
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="content d-flex justify-content-center align-items-center">
                <form id="reset-password-form" method="POST" class="login-form"
                    action="{{ route('password.reset.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $data['token'] }}">
                    <input type="hidden" name="email" class="form-control"
                        value="{{ $data['email'] ?? old('email') }}" readonly>
                    <div class="card mb-0 login_box">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('images/logo.png') }}" width="100">
                                <h5 class="mb-0 sp-des">Reset Password</h5>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" id="password" name="password"
                                    class="form-control show-password-sd" placeholder="Password" required>
                                <div style="margin-top: 3px;">
                                    <span>
                                        <input type="checkbox" class="show-password-checkbox">
                                    </span>
                                    <span style="margin-left: 3px;">Show Password</span>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" id="password-confirm" name="password_confirmation"
                                    class="form-control show-password-sd" placeholder="Confirm Password" required>
                                <div style="margin-top: 3px;">
                                    <span>
                                        <input type="checkbox" class="show-password-checkbox">
                                    </span>
                                    <span style="margin-left: 3px;">Show Password</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block session-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("strong_password", function(value, element) {
                let password = value;
                if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$#_!%*?&]{8,}/.test(password))) {
                    return false;
                }
                return true;
            }, function(value, element) {
                let password = $(element).val();
                if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$#_!%*?&]{8,}/.test(password))) {
                    return 'Password should be at least 8 characters and a combination of letters and digits.';
                }
                return false;
            });

            $('#reset-password-form').validate({
                rules: {
                    password: {
                        required: true,
                        strong_password: true,
                    },
                    password_confirmation: {
                        required: true,
                        strong_password: true,
                        equalTo: "#password"
                    },
                },
                messages: {},
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "file[]")
                        error.insertAfter(".custom-file-res");
                    else
                        error.insertAfter(element);
                }
            });
            $(".show-password-checkbox").on("change", function() {
                var x = $(this).parent("span").parent("div").siblings(".show-password-sd");
                if ($(x).attr("type") === "password") {
                    $(x).attr("type", "text")
                } else {
                    $(x).attr("type", "password")
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>
