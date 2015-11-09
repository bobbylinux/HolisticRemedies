@extends('layouts.back')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.dash_clienti_edit_titolo',0) }}</h2>
</div>
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
    </li>
    <li class="active">
        <i class="fa fa-user"></i> Clienti
    </li>
</ol>
{!!Form::open(array('url'=>'admin/clienti/'.$cliente->id,'method'=>'PUT'))!!}
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('user_id', Lang::choice('messages.dash_clienti_edit_user_id',0)) !!}
            {!! Form::text('user_id', $cliente->utenti->id, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('user_id') as $message)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <p class="bg-danger">{!! $message !!}</p>
    </div>
</div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('cognome', Lang::choice('messages.dash_clienti_edit_cognome',0)) !!}
            {!! Form::text('cognome', $cliente->cognome, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('cognome') as $message)
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <p class="bg-danger">{!! $message !!}</p>
    </div>
</div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('nome', Lang::choice('messages.dash_clienti_edit_nome',0)) !!}
            {!! Form::text('nome', $cliente->nome, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('nome') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('societa', Lang::choice('messages.dash_clienti_edit_societa',0)) !!}
            {!! Form::text('societa', $cliente->societa, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('societa') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('telefono', Lang::choice('messages.dash_clienti_edit_telefono',0)) !!}
            {!! Form::text('telefono', $cliente->telefono, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('telefono') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('email', Lang::choice('messages.dash_clienti_edit_email',0)) !!}
            {!! Form::text('email', $cliente->utenti->username, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('email') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('indirizzo', Lang::choice('messages.dash_clienti_edit_indirizzo',0)) !!}
            {!! Form::text('indirizzo', $cliente->indirizzo, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('indirizzo') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('cap', Lang::choice('messages.dash_clienti_edit_cap',0)) !!}
            {!! Form::text('cap', $cliente->cap, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('cap') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('comune', Lang::choice('messages.dash_clienti_edit_citta',0)) !!}
            {!! Form::text('comune', $cliente->comune, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('comune') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('provincia', Lang::choice('messages.dash_clienti_edit_provincia',0)) !!}
            {!! Form::text('provincia', $cliente->provincia, array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('provincia') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('nazione', Lang::choice('messages.dash_clienti_edit_stato',0)) !!}
            {!! Form::select('nazione', array('0' => Lang::choice('messages.dash_clienti_edit_stato',0)) +
            $nazioni, $cliente->nazione,array('class'=>'form-control')) !!}
        </div>
    </div>
</div>
@foreach($errors->get('stato') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="checkbox">
            {!! Form::label('confermato', Lang::choice('messages.dash_clienti_edit_confermato',0)) !!}
            {{ Form::checkbox('confermato',$cliente->utenti->confermato) }}
        </div>
    </div>
</div>
@foreach($errors->get('confermato') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group">
            {!! Form::label('ruolo', Lang::choice('messages.dash_clienti_edit_ruolo',0)) !!}
            @if ($cliente->utenti->ruolo == 1)
                {{ Form::checkbox('ruolo',true) }}
            @elseif($cliente->utenti->ruolo == 2)
                {{ Form::checkbox('ruolo',false) }}
            @endif
        </div>
    </div>
</div>
@foreach($errors->get('ruolo') as $message)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="bg-danger">{!! $message !!}</p>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="form-group">
            {!! Form::submit(Lang::choice('messages.dash_clienti_edit_pulsante_modifica',0), array('class' =>'btn btn-success'))!!}
        </div>
    </div>
</div>
{!!Form::close()!!}
@stop


