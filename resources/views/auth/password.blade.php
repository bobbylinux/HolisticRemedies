@extends('layouts.basic')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{!! Lang::choice('messages.titolo_recupera_password',0) !!}</h2>
                </div>
                <div class="panel-body">
                    <p>{!! Lang::choice('messages.istruzioni_reset_password',0) !!}</p>
                    {!!Form::open(['url'=>'auth/password','class'=>'change-password form-','style'=>'margin-top:10px'])!!}
                        <div class="form-group">
                            {!! Form::label('email', Lang::choice('messages.username',0)) !!}
                            {!! Form::text('email', '', array('class'=>'form-control','type'=>'email','placeholder'=>'E-Mail')) !!}
                        </div>
                        @foreach($errors->get('email') as $message)
                            <div class="row">
                                <div class="col-xs-12">
                                    <p class="bg-danger">{!! $message !!}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            {!! Form::label('password', Lang::choice('messages.nuova_password',0)) !!}
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                        </div>
                        @foreach($errors->get('password') as $message)
                            <div class="row">
                                <div class="col-xs-12">
                                    <p class="bg-danger">{!! $message !!}</p>
                                </div>
                            </div>
                        @endforeach
                    <div class="form-group">
                        {!! Form::label('password_c', Lang::choice('messages.password_c',0)) !!}
                        {!! Form::password('password_c',['class'=>'form-control','placeholder'=>'Password']) !!}
                    </div>
                        @foreach($errors->get('password_c') as $message)
                            <div class="row">
                                <div class="col-xs-12">
                                <p class="bg-danger">{!! $message !!}</p>
                                </div>
                            </div>
                        @endforeach
                        {!!Form::submit(Lang::choice('messages.pulsante_conferma',0),['class'=>'btn btn-lg btn-default btn-block'])!!}
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@stop

