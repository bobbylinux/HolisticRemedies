@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{!!Lang::choice('messages.dash_sconti_pagamento_create_titolo',0)!!}</h2>
    </div>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
        </li>
        <li class="active">
            <i class="fa fa-money"></i> Sconti
        </li>
        <li class="active">
            <i class="fa fa-money"></i> <a href="{{url('admin/sconti/pagamento')}}">Pagamento</a>
        </li>
        <li class="active">
            <i class="fa fa-file"></i> Nuovo
        </li>
    </ol>
    {!!Form::open(array('url'=>'admin/sconti/pagamento','method'=>'POST','id'=>'form-sconti-pagamento' ))!!}
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('tipo_pagamento', Lang::choice('messages.dash_sconti_pagamento_create_tipo_pagamento',0)) !!}
                {!! Form::select('tipo_pagamento', array('0' => Lang::choice('messages.dash_sconti_pagamento_create_seleziona_tipo_pagamento',0)) +
            $tipopagamento, 0,array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>
    @foreach($errors->get('tipo_pagamento') as $message)
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('sconto', Lang::choice('messages.dash_sconti_pagamento_create_sconto',0)) !!}
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
                {!! Form::submit(Lang::choice('messages.dash_sconti_pagamento_create_pulsante_crea',0), array('class' =>'btn btn-success'))!!}
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@stop

