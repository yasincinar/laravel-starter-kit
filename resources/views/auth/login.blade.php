<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giriş Paneli</title>

    <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <style type="text/css">

        .logo-center img {
            margin: 20px auto;
            display: block;
            max-width: 240px;
            text-align: center;
        }

        input.login {
            height: 50px;
            border: 1px solid #dddddd;
            font-size: 20px;
        }

        .remember-me {
            background-color: red;
        }

        .col-sm-12 > .btn {
            height: 50px;
            background-color: #3c8dbc;
            font-size: 20px;
            color: #dcdada;
            font-weight: 400;
        }

        .forgot-password {
            color: #888;
        }

        .error{
            color:indianred;
        }

    </style>
</head>
<body>
<div id="wrapper">
    <div class="container">
        <div class="row login-wrapper">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="logo logo-center">
                        <a href="{{url('/')}}">
                            <img class="text-centered" src="{{url('assets/img/logo.png')}}" alt="">
                        </a>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="login-post" method="post" role="form"
                                      style="display: block;">
                                    @if (session('login_err'))
                                        <div class="alert alert-danger">
                                            <i class="fa fa-times-circle-o"></i> {{ session('login_err') }}
                                        </div>
                                    @endif
                                    <div class="form-group" id="email-div">
                                        <input type="text" name="email" id="email" tabindex="1"
                                               class="form-control login required email"
                                               placeholder="E-Posta Adresiniz" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group" id="password-div">
                                        <input type="password" name="password" id="password" tabindex="2"
                                               class="form-control login required"
                                               placeholder="Şifreniz">
                                    </div>
                                    <div class="form-group pull-right">
                                        <input type="checkbox" tabindex="3" class="remember-me" name="remember"
                                               id="remember">
                                        <label for="remember">  &nbsp; Beni Hatırla</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="form-control btn btn-default">Giriş Yap
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <a href="#" class="forgot-password pull-right">Şifremi
                                                    Unuttum</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script type="text/javascript" src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jQuery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="/assets/plugins/jQuery-validation/dist/localization/messages_tr.min.js"></script>
<script type="text/javascript" src="/assets/js/common.js"></script>
<script>
    $(document).ready(function () {
        //Email error array
        var emailErrors = '{{ json_encode($errors->get('email')) }}';
        emailErrors = emailErrors.replace(/&quot;/g, "\"");
        emailErrors = JSON.parse(emailErrors);
        //Password error array
        var passwordErrors = '{{ json_encode($errors->get('password')) }}';
        passwordErrors = passwordErrors.replace(/&quot;/g, "\"");
        passwordErrors = JSON.parse(passwordErrors);

        //Email and password divs
        var $emailDiv = $('#email-div');
        var $passwordDiv = $('#password-div');

        //Add has-error class if email error exists
        if (emailErrors.length > 0) {
            $emailDiv.addClass('has-error');
            emailErrors.forEach(function (e) {
                $emailDiv.prepend('<label class="control-label error-label" for="email"><i class="fa fa-times-circle-o"></i> ' + firstLetterUpper(e) + '</label>');
            });
        }
        //Add has-error class if password error exists
        if (passwordErrors.length > 0) {
            $passwordDiv.addClass('has-error');
            passwordErrors.forEach(function (e) {
                $passwordDiv.prepend('<label class="control-label error-label" for="email"><i class="fa fa-times-circle-o"></i> ' + firstLetterUpper(e) + '</label>');
            });
        }

        //Remove errors on focus
        $('#email').on('focus', function () {
            $('#email-div > .error-label').remove();
            $emailDiv.removeClass('has-error');
        });
        $('#password').on('focus', function () {
            $('#password-div > .error-label').remove();
            $passwordDiv.removeClass('has-error');
        });

        //Validate form
        $('#login-form').validate({
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
</body>
</html>



