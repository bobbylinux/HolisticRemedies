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
    <link href="{{ url('css/front.style.css') }}" rel="stylesheet">

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

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-front navbar-default navbar-fixed-top" role="navigation" id="nav-main">
    <div class="container">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-fw fa-home hidden-lg"></i><span
                        class="hidden-md hidden-sm hidden-xs">HOLISTIC REMEDIES</span></a>
            <a class="navbar-brand hidden-md hidden-lg" href="https://www.facebook.com/CaisseFormula/"
               target="_blank"><i
                        class="fa fa-facebook"></i></a>
            @if (Auth::check())
                <a class="navbar-brand hidden-md hidden-lg" href="{!! url('carrello') !!}"><span
                            class="badge cart-count">{!! $cartcount !!}</span><i
                            class="fa fa-shopping-cart"></i></a>
            @endif
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
            <ul class="nav navbar-nav navbar-left">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a class="page-scroll" href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#tips"> {!!Lang::choice('messages.menu_front_consigli',0)!!}</a>
                </li>
                <li>
                    <a class="page-scroll"
                       href="#ingredients"> {!!Lang::choice('messages.menu_front_ingredienti',0)!!}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#buy"> {!!Lang::choice('messages.menu_front_acquista',0)!!}</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::check())
                    <li>
                        <a class="hidden-md hidden-lg" href="auth/login"><i
                                    class="fa fa-fw fa-user"></i> {!! Lang::choice('messages.menu_accedi',0) !!}</a>
                    </li>
                    <li class="dropdown hidden-xs hidden-sm">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><i
                                    class="fa fa-fw fa-user"></i> {!! Lang::choice('messages.menu_accedi',0) !!}<span
                                    class="caret"></span></a>

                        <div class="dropdown-menu dropdown-login">
                            {!!Form::open(['url'=>'auth/login','class'=>'form-login form-signin','data-token' => csrf_token(),'style'=>'margin:10%;'])!!}
                            <div class="form-group">
                                <label for="username">Email</label>
                                {!! Form::text('username','',['class'=>'form-control','type'=>'email','id'=>'username','placeholder'=>'Email'])!!}
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','id'=>'password']) !!}
                            </div>
                            <div class="form-group">
                                <p class="bg-success login-errors" style="text-align: center;"></p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           value="remember-me"> {!! Lang::choice('messages.check_ricordami',0) !!}
                                </label>
                            </div>
                            <div class="form-group">
                                <a href="{!! url('auth/password')!!}">{!! Lang::choice('messages.password_dimenticata',0) !!}</a>
                            </div>
                            <div class="form-group">
                                {!!Form::submit(Lang::choice('messages.pulsante_accedi',0),['class'=>'btn btn-lg btn-default btn-block'])!!}
                            </div>
                            <div class="form-group">
                                <a href="{!! url('auth/register')!!}"
                                   class="btn btn-default btn-lg btn-block">{!! Lang::choice('messages.pulsante_registrati',0) !!}</a>
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </li>
                @else
                    <li class="hidden-sm hidden-xs"><a href="{!! url('carrello') !!}"><span
                                    class="badge cart-count">{!! $cartcount !!}</span><i
                                    class="fa fa-shopping-cart"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span
                                    >{!! Auth::user()->username !!}</span> <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->ruolo == 1)
                                <li>
                                    <a href="{!! url('admin') !!}"><i
                                                class="fa fa-fw fa-dashboard"></i> {!! Lang::choice('messages.pannello_di_controllo',0) !!}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{!! url('ordini/utente') !!}"><i
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

                <li class="hidden-sm hidden-xs"><a href="https://www.facebook.com/CaisseFormula/" target="_blank"><i
                                class="fa fa-facebook"></i><span class="hidden-sm"> FACEBOOK</span></a></li>
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
<!-- Intro Section -->
<section id="intro" class="intro-section">
    <div class="container">
        @yield('intro')
    </div>
</section>
<!-- Tips Section -->
<section id="tips" class="tips-section">
    <div class="container">
        @yield('tips')
    </div>
</section>
<!-- Ingredients Section -->
<section id="ingredients" class="ingredients-section">
    <div class="container">
        @yield('ingredients')
    </div>
</section>
<!-- Shop Section -->
<section id="buy" class="shop-section">
    <div class="container">
        @yield('shop')
    </div>
</section>
<section id="footer" class="footer-section">
    <h5>Caisse Formula è un integratore alimentare prodotto da: Herb Works - Guelph Ontario - Canada</h5>
    <h6>Distribuito in Italia da: Holistic Remedies - Via Piave, 99 - 50068 Rufina (Firenze)</h6>
    <h6>Tel.: +39.055. 8395388 - Fax: +39.055.8395989 - Mail: info@caisse.it</h6>
    <h6>Iscrizione REA Firenze 503598 - Registro Imprese 19717 - P. IVA 04957430483</h6>
</section>
<!-- jQuery -->
<script src="{{ url('js/jquery.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>

<!-- Scrolling Nav JavaScript -->
<script src="{{ url('js/jquery.easing.min.js') }}"></script>
<script src="{{ url('js/front.script.js') }}"></script>
<script src="{{ url('js/cart.script.js') }}"></script>
<script src="{{ url('js/login.script.js') }}"></script>

</body>

</html>
