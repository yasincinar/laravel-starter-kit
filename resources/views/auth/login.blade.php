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
                                <form id="login-form" action="" method="post" role="form"
                                      style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1"
                                               class="form-control login"
                                               placeholder="E-Posta Adresiniz">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2"
                                               class="form-control login"
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
                                    {{csrf_token()}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>



