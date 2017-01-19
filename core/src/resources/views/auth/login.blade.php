<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Leafr Backoffice - Login</title>

    <!-- Styles -->
    <link href="/assets/css/leafr.core.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style media="screen">
        html, body { margin: 0; height:100%; }
        body {
            display:flex;
            flex-direction: column;
            -ms-align-items: inherit;
            align-items: center;
            justify-content: center ;
            background:url('/assets/img/core-background.jpg') repeat;
        }
        .login {
            width:30%;
        }
        .box {
            background:rgba(255,255,255,1);
            border-radius: 8px;
        }

        .login input {
            padding:15px;
            background:transparent;
        }

        .login input:focus {
            background:rgba(255,255,255,.3);
        }

        .login p {
            padding:1rem 0 0;
            margin-bottom:0;
        }
        .login p a {
            opacity:.5;
        }
        .login p a:hover {
            opacity:1;
        }

        .login input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
           color: rgba(0,0,0,.9);
        }
        .login input::-moz-placeholder { /* Firefox 19+ */
          color: rgba(0,0,0,.9);
        }
        .login input:-ms-input-placeholder { /* IE 10+ */
          color: rgba(0,0,0,.9);
        }
        .login input:-moz-placeholder { /* Firefox 18- */
          color: rgba(0,0,0,.9);
        }

    </style>

</head>
<body>

<section class="login">
    <div class="box">
        <form role="form" method="POST" action="/backoffice/login">
            {{ csrf_field() }}

            <div class="form-group">

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>



            </div>

            <div class="form-group">

                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>



            </div>

            <div class="form-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <div class="form-group">
                    <button type="submit" class="btn is-wide">
                        Login
                    </button>
            </div>
        </form>

        <p class="text-right">
            <a href="{{ url('/password/reset') }}">
                Forgot Your Password?
            </a>
        </p>
    </div>
</section>



</body>
