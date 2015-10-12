@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{{ Lang::choice('messages.dash_sconti_quantita_create_titolo',0) }}</h2>
    </div>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
        </li>
        <li class="active">
            <i class="fa fa-money"></i> Sconti
        </li>
        <li class="active">
            <i class="fa fa-money"></i> <a href="{{url('admin/sconti/quantita')}}">Quantit&agrave;</a>
        </li>
        <li class="active">
            <i class="fa fa-file"></i> Nuovo
        </li>
    </ol>
    {!!Form::open(array('url'=>'admin/sconti/quantita','method'=>'POST','id'=>'form-sconto-quantita' ))!!}
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('quantita_min', Lang::choice('messages.dash_sconti_quantita_create_quantita_minima',0)) !!}
                {!! Form::text('quantita_min', '', array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>
    @foreach($errors->get('quantita_min') as $message)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('quantita_max', Lang::choice('messages.dash_sconti_quantita_create_quantita_massima',0)) !!}
                {!! Form::text('quantita_max', '', array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>
    @foreach($errors->get('quantita_max') as $message)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('sconto', Lang::choice('messages.dash_sconti_quantita_create_sconto',0)) !!}
                {!! Form::text('sconto', '', array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>
    @foreach($errors->get('sconto') as $message)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                {!! Form::submit(Lang::choice('messages.dash_sconti_quantita_create_pulsante_crea',0), array('class' =>'btn btn-success'))!!}
            </div>
        </div>
    </div>z                
    {!!Form::close()!!}
@stop

