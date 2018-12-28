<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page | Nifty - Admin Template</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{asset('niftyadmin/css/bootstrap.min.css')}}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{asset('niftyadmin/css/nifty.min.css')}}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{asset('niftyadmin/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">



    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{asset('niftyadmin/css/demo/nifty-demo.min.css')}}" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/magic-check/css/magic-check.min.css')}}" rel="stylesheet">

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{asset('niftyadmin/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('niftyadmin/plugins/pace/pace.min.js')}}"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="{{asset('niftyadmin/js/jquery-2.2.4.min.js')}}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{asset('niftyadmin/js/bootstrap.min.js')}}"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{asset('niftyadmin/js/nifty.min.js')}}"></script>


    <!--=================================================-->

    <!--Background Image [ DEMONSTRATION ]-->
    <script src="{{asset('niftyadmin/js/demo/bg-images.js')}}"></script>

</head>
<body>
<div id="container" class="cls-container">

    <!-- BACKGROUND IMAGE -->
    <!--===================================================-->
    <div id="bg-overlay"></div>


    <!-- LOGIN FORM -->
    <!--===================================================-->
    <div class="cls-content">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h3 class="h4 mar-no">Account Login</h3>
                    <p class="text-muted">Sign In to your account</p>
                </div>
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="用户名" value="{{ old('username') }}" autofocus>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="密码">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label for="demo-form-checkbox">Remember me</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                </form>
            </div>

            <div class="pad-all">
                <a href="pages-password-reminder.html" class="btn-link mar-rgt">Forgot password ?</a>
                <a href="pages-register.html" class="btn-link mar-lft">Create a new account</a>

                <div class="media pad-top bord-top">
                    <div class="pull-right">
                        <a href="#" class="pad-rgt"><i class="demo-psi-facebook icon-lg text-primary"></i></a>
                        <a href="#" class="pad-rgt"><i class="demo-psi-twitter icon-lg text-info"></i></a>
                        <a href="#" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>
                    </div>
                    <div class="media-body text-left">
                        Login with
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===================================================-->


    <!-- DEMO PURPOSE ONLY -->
    <!--===================================================-->
    <div class="demo-bg">
        <div id="demo-bg-list">
            <div class="demo-loading"><i class="psi-repeat-2"></i></div>
            <img class="demo-chg-bg bg-trans active" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-trns.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-1.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-2.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-3.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-4.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-5.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-6.jpg')}}" alt="Background Image">
            <img class="demo-chg-bg" src="{{asset('niftyadmin/img/bg-img/thumbs/bg-img-7.jpg')}}" alt="Background Image">
        </div>
    </div>
    <!--===================================================-->



</div>
<!-- 你的HTML代码 -->

<!--<script src="{{asset('layui/layui.js')}}"></script>-->
</body>
</html>