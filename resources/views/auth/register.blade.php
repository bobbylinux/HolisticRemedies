@extends('layouts.basic')
@section('content')
    <div class="col-md-4 col-md-offset-4 col-xs-8">
        {!!Form::open(array('url'=>'auth/register','method'=>'POST'))!!}
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="margin-bottom: 20px">
                    <h2>{!!Lang::choice('messages.registrazione',0)!!}</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('username', Lang::choice('messages.username',0)) !!}
                            {!! Form::text('username', '', array('class'=>'form-control','placeholder'=>Lang::choice('messages.username',0))) !!}
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
                            {!! Form::text('username_c', '', array('class'=>'form-control','placeholder'=>Lang::choice('messages.username',0))) !!}
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
                            {!! Form::label('password', Lang::choice('messages.password',0)) !!}
                            {!! Form::password('password', array('class'=>'form-control','placeholder'=>'password')) !!}
                        </div>
                    </div>
                </div>
                @foreach($errors->get('password') as $message)
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="bg-danger">{!! $message !!}</p>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('password_c', Lang::choice('messages.password_c',0)) !!}
                            {!! Form::password('password_c', array('class'=>'form-control','placeholder'=>'password')) !!}
                        </div>
                    </div>
                </div>
                @foreach($errors->get('password_c') as $message)
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="bg-danger">{!! $message !!}</p>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <a href="{!! url('/') !!}" class="btn btn-default"> {!! Lang::choice('messages.pulsante_annulla',0) !!}</a>
                            {!! Form::submit(Lang::choice('messages.pulsante_crea_account',0), array('class' =>'btn btn-default'))!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
