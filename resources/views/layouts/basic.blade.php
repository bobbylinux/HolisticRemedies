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
        <!-- Navigation -->
        <nav class="navbar navbar-front navbar-default navbar-fixed-top" role="navigation" id="nav-main">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="{!! url('/')!!}"><i class="fa fa-fw fa-home hidden-lg"></i><span
                            class="hidden-md hidden-sm hidden-xs">HOLISTIC REMEDIES</span></a>
                    @if (App::getLocale() == "en")
                    <a class="navbar-brand hidden-md hidden-lg" href="{!! url('lang/it') !!}"><span
                            class="flag-icon flag-icon-it"></span><span
                            class="hidden-sm hidden-xs"> {{ Config::get('languages')[App::getLocale()] }}</span></a>
                    @elseif (App::getLocale() == "it")
                    <a class="navbar-brand hidden-md hidden-lg" href="{!! url('lang/en') !!}"><span
                            class="flag-icon flag-icon-gb"></span><span
                            class="hidden-sm hidden-xs"> {{ Config::get('languages')[App::getLocale()] }}</span></a>
                    @endif        
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                        <li><a href="{!! url('carrello') !!}" ><span class="badge cart-count">{!! $cartcount !!}</span><i class="fa fa-shopping-cart"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {!! Auth::user()->username !!} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->ruolo == 1)
                                <li>
                                    <a href="{!! url('admin') !!}"><i
                                            class="fa fa-fw fa-dashboard"></i> {!! Lang::choice('messages.pannello_di_controllo',0) !!}
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="#"><i
                                            class="fa fa-fw fa-truck"></i> {!! Lang::choice('messages.miei_ordini',0) !!}
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i
                                            class="fa fa-fw fa-cog"></i> {!! Lang::choice('messages.profilo',0) !!}
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{!! url('/auth/logout')!!}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (App::getLocale() == "en")
                        <li><a class="hidden-sm hidden-xs" href="{!! url('lang/it') !!}"><span
                                    class="flag-icon flag-icon-it"></span><span
                                    class="hidden-md"> {{ Config::get('languages')[App::getLocale()] }}</span></a></li>
                        @elseif (App::getLocale() == "it")
                        <li><a class="hidden-sm hidden-xs" href="{!! url('lang/en') !!}"><span
                                    class="flag-icon flag-icon-gb"></span><span
                                    class="hidden-md"> {{ Config::get('languages')[App::getLocale()] }}</span></a></li>
                        @endif
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- Content Section -->
        <section id="intro" class="intro-section">
            <div class="container">
                @yield('content')
            </div>
        </section>
        <div id="wait-msg" class="col-sm-12" style="display:none;">
            <h3>{!!Lang::choice('messages.attendere',0)!!}</h3>
        </div>
        <!-- jQuery -->
        <script src="{{ url('js/jquery.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ url('js/bootstrap.min.js') }}"></script>

        <!-- Scrolling Nav JavaScript -->
        <script src="{{ url('js/jquery.easing.min.js') }}"></script>
        <script src="{{ url('js/front.script.js') }}"></script>
        <script src="{{ url('js/blockui.js') }}"></script>
        <script src="{{ url('js/cart.script.js') }}"></script>
    </body>

</html>
