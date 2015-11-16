@extends('layouts.basic')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            {!!Form::open(array('url'=>'utente/profilo','method'=>'POST'))!!}
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="panel-heading"><h2>{!!Lang::choice('messages.profilo_titolo',0)!!}</h2></div>
                    {!! Form::token() !!}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('cognome,', Lang::choice('messages.cognome',0)) !!}
                                {!! Form::text('cognome', $cliente->cognome, array('class'=>'form-control','placeholder'=>Lang::choice('messages.cognome',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('cognome') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('nome,', Lang::choice('messages.nome',0)) !!}
                                {!! Form::text('nome', $cliente->nome, array('class'=>'form-control','placeholder'=>Lang::choice('messages.nome',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('nome') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('indirizzo,', Lang::choice('messages.indirizzo',0)) !!}
                                {!! Form::text('indirizzo', $cliente->indirizzo, array('class'=>'form-control','placeholder'=>Lang::choice('messages.indirizzo',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('indirizzo') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('citta,', Lang::choice('messages.citta',0)) !!}
                                {!! Form::text('citta', $cliente->comune, array('class'=>'form-control','placeholder'=>Lang::choice('messages.citta',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('citta') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('cap,', Lang::choice('messages.cap',0)) !!}
                                {!! Form::text('cap', $cliente->cap, array('class'=>'form-control','placeholder'=>Lang::choice('messages.cap',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('cap') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('provincia,', Lang::choice('messages.provincia',0)) !!}
                                {!! Form::text('provincia', $cliente->provincia, array('class'=>'form-control','placeholder'=>Lang::choice('messages.provincia',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('provincia') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('stato,', Lang::choice('messages.stato',0)) !!}
                                {!! Form::select('stato', $nazioni, $cliente->nazione,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('citta') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('telefono,', Lang::choice('messages.telefono',0)) !!}
                                {!! Form::text('telefono', $cliente->telefono, array('class'=>'form-control','placeholder'=>Lang::choice('messages.telefono',0))) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('telefono') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('username', Lang::choice('messages.username',0)) !!}
                                {!! Form::text('username', $cliente->utenti->username, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('username') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::label('username_c', Lang::choice('messages.username_c',0)) !!}
                                {!! Form::text('username_c', $cliente->utenti->username, array('class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    @foreach($errors->get('username_c') as $message)
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! Form::submit(Lang::choice('messages.pulsante_crea_account',0), array('class' =>'btn btn-success btn-block'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <a href="{!! url('/') !!}"
                                   class="btn btn-block btn-default"> {!! Lang::choice('messages.pulsante_annulla',0) !!}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop
