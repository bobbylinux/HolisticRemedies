@extends('layouts.basic')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-12">
            <div class='panel'>
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{!!$error!!}</p>
                @endforeach
                {!!Form::open(['url'=>'auth/login','class'=>'form-login','data-token' => csrf_token(),'style'=>'margin:5%;'])!!}

                <div class="form-group">
                    <label for="username">Email</label>
                    {!! Form::text('username','',['class'=>'form-control','type'=>'email','id'=>'username','placeholder'=>'Email'])!!}
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','id'=>'password']) !!}
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

            </div>
            {!!Form::close()!!}
        </div>

    </div>
    </div>
@stop

