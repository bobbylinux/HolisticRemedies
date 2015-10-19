<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Holistic Remedies</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ url('css/style.css') }}" rel="stylesheet">

        <!-- font-flag CSS-->
        <link href="{{ url('css/flag-icon.min.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ url('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

    <body>
        <!-- Content Section -->
        <section id="" class="">
            <div class="container">
                @yield('content')
            </div>
        </section>

        <!-- jQuery -->
        <script src="{{ url('js/jquery.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ url('js/bootstrap.min.js') }}"></script>

        <!-- Scrolling Nav JavaScript -->
        <script src="{{ url('js/jquery.easing.min.js') }}"></script>
        <script src="{{ url('js/front.script.js') }}"></script>

    </body>

</html>
