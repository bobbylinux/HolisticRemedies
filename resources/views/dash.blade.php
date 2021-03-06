@extends('layouts.back')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {!! Lang::choice('messages.pannello_di_controllo',0) !!}
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> {!! Lang::choice('messages.pannello_di_controllo',0) !!}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">0</div>
                            <div>{!! Lang::choice('messages.nuovi_iscritti_newsletter',0) !!}</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{!! Lang::choice('messages.vai',0) !!}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$newOrders}}</div>
                            <div>{!! Lang::choice('messages.nuovi_ordini',0) !!}</div>
                        </div>
                    </div>
                </div>
                <a href="{!! url('/admin/ordini/new') !!}">
                    <div class="panel-footer">
                        <span class="pull-left">{!! Lang::choice('messages.vai',0) !!}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$newUsers}}</div>
                            <div>{!! Lang::choice('messages.nuovi_utenti',0) !!}</div>
                        </div>
                    </div>
                </div>
                <a href="{!! url('/admin/clienti/new') !!}">
                    <div class="panel-footer">
                        <span class="pull-left">{!! Lang::choice('messages.vai',0) !!}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

@stop
