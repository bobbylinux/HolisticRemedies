@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{!!Lang::choice('messages.dash_prodotti_edit_titolo',0)!!}</h2>
    </div>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
        </li>
        <li class="active">
            <i class="fa fa-th-large"></i> <a href="{{url('admin/sconti/pagamento')}}">Prodotti</a>
        </li>
        <li class="active">
            <i class="fa fa-edit"></i> Modifica
        </li>
    </ol>
    {!!Form::open(array('url'=>'admin/prodotti/'.$prodotto->id,'method'=>'PUT'))!!}
    @foreach($errors->get('codice') as $message)
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('titolo_prodotto', Lang::choice('messages.dash_prodotti_create_prodotto_nome',0)) !!}
                {!! Form::text('titolo_prodotto', $prodotto->prodotto, array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>
    @foreach($errors->get('titolo') as $message)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('descrizione_prodotto', Lang::choice('messages.dash_prodotti_create_prodotto_descrizione',0)) !!}
                {!! Form::textarea('descrizione_prodotto', $prodotto->descrizione , array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>
    @foreach($errors->get('descrizione') as $message)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                {!! Form::label('immagini_prodotto', Lang::choice('messages.dash_prodotti_create_prodotto_immagine',0)) !!}
                {!! Form::file('immagini_prodotto', array('class'=>'form-control')) !!}
            </div>
        </div>
    </div>

    @foreach($errors->get('immagine') as $message)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="bg-danger">{!! $message !!}</p>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                {!! Form::submit(Lang::choice('messages.dash_prodotti_create_pulsante_crea',0), array('class' =>'btn btn-success'))!!}
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@stop

