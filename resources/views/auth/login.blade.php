<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Holistic Remedies</title>

        <!-- Bootstrap -->
        <link href="{!! url('css/bootstrap.min.css')!!}" rel="stylesheet">


        <!-- Custom styles for this template -->
        <link href="{!! url('css/login.css')!!}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">HOLISTIC REMEDIES</a>
                </div>

                <!-- /.navbar-collapse -->
            </nav>
            <div class="col-md-4 col-md-offset-4">
                @foreach($errors->all() as $error)
                <p class="alert alert-danger">{!!$error!!}</p>
                @endforeach
                {!!Form::open(['url'=>'auth/login','class'=>'cart-form','data-token' => csrf_token(),'style'=>'margin-top:10px'])!!}
                <label for="inputEmail" class="sr-only">Email</label>
                {!! Form::text('username','',['class'=>'form-control','type'=>'email','id'=>'username','placeholder'=>'Email'])!!}
                <label for="inputPassword" class="sr-only">Password</label>
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','id'=>'password']) !!}
                <div class="checkbox">
                    <label>
                        <input type="checkbox"
                               value="remember-me"> {!! Lang::choice('messages.check_ricordami',0) !!}
                    </label>
                </div>
                {!!Form::submit(Lang::choice('messages.pulsante_accedi',0),['class'=>'btn btn-lg btn-default btn-block'])!!}
                <a href="{!! url('auth/register')!!}"
                   class="btn btn-default btn-lg btn-block">{!! Lang::choice('messages.pulsante_registrati',0) !!}</a>
                {!!Form::close()!!}
            </div>
        </div>
        <!-- /container -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{!! url('js/ie10-viewport-bug-workaround.js')!!}"></script>
    </body>
</html>

