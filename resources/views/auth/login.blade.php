<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TELEONCOREHAB STUDY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: max(5vw, 50px);
            padding-bottom: 40px;
            background-color: white;
        }

        .form-signin {
            max-width: min(60vw, 500px);
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .logo {
            max-width: 250px;
            position: relative;
            margin: 0 auto;
            width: 100%;
        }
    </style>
</head>

<body>

<div class="container">
    <p align="center"><img class="logo" style="max-width: 60vw; width: 500px;" src="biglogo.png?new"/></p>
    <form method="POST" action="{{ url('/login') }}" class="form-signin">

        {{ csrf_field() }}

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email адрес" required
               autofocus>
        @if ($errors->has('email'))
            <span class="help-block error-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
        @if ($errors->has('password'))
            <span class="help-block error-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
        @endif

        <button class="btn btn btn-primary btn-block" style="background-color: #0d6279; border: none;" type="submit">Вход</button>
        <p style="margin-top: 15px;">
            <a style="color: #0d6279;" href="{{url('/register')}}"><i class="icon ion-person-add"></i>&nbsp;Регистрация на платформе</a><br>
            <a style="color: #0d6279;" href="{{url('/password/reset')}}">&nbsp;<i class="icon ion-key"></i>&nbsp;&nbsp;Забыли пароль?</a>
        </p>
    </form>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>


</body>
</html>
