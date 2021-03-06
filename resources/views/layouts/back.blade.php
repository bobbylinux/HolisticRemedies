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
        <link href="{{ url('css/back.style.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ url('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">HOLISTIC REMEDIES</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu alert-dropdown">

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {!! Auth::user()->username !!} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{!! url('/auth/logout')!!}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li @if(Request::url() === url('/admin')) class="active" @endif >
                             <a href="{{ url('/admin') }}"><i class="fa fa-fw fa-dashboard"></i> Pannello di controllo</a>
                        </li>
                        <li @if(Request::url() === url('/admin/prodotti')) class="active" @endif >
                             <a href="{{ url('/admin/prodotti') }}"><i class="fa fa-fw fa-th-large"></i> Prodotti</a>
                        </li>
                        <li @if(Request::url() === url('/admin/clienti')) class="active" @endif >
                             <a href="{{ url('/admin/clienti') }}"><i class="fa fa-fw fa-user"></i> Clienti</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-money"></i> Sconti <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li @if(Request::url() === url('/admin/sconti')) class="active" @endif >
                                     <a href="{{ url('/admin/sconti/quantita') }}"> Quantit&agrave;</a>
                                </li>
                                <li @if(Request::url() === url('/admin/sconti')) class="active" @endif >
                                     <a href="{{ url('/admin/sconti/pagamento') }}"> Tipo Pagamento</a>
                                </li>
                                <li @if(Request::url() === url('/admin/sconti')) class="active" @endif >
                                    <a href="{{ url('/admin/sconti/totale') }}"> Totale Ordine</a>
                                </li>
                            </ul>
                        </li>
                        <li @if(Request::url() === url('/admin/ordini')) class="active" @endif >
                             <a href="{{ url('/admin/ordini') }}"><i class="fa fa-fw fa-truck"></i> Ordini</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4>{!! Lang::choice('messages.attenzione',0) !!}</h4>
                    </div>
                    <div class="modal-body">
                      {!! Lang::choice('messages.modal_cancellazione',0) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-danger btn-delete">{!! Lang::choice('messages.pulsante_conferma',0) !!}</button>
                        <button type="button"
                                data-dismiss="modal" class="btn btn-default">{!! Lang::choice('messages.pulsante_annulla',0) !!}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ url('js/jquery.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ url('js/bootstrap.min.js') }}"></script>
        <script src="{{ url('js/back.script.js') }}"></script>
        <!-- cookies law bar -->
        <script src="//cdn.jsdelivr.net/cookie-bar/1/cookiebar-latest.min.js"></script>
    </body>

</html>