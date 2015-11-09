@extends('layouts.basic')
@section('content')
<div class="row">
   <div class="col-md-4 col-md-offset-4 col-sm-12">
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'auth/login','class'=>'cart-form','data-token' => csrf_token(),'style'=>'margin-top:10px'])!!}
        <label for="username" >Email</label>
        {!! Form::text('username','',['class'=>'form-control','type'=>'email','id'=>'username','placeholder'=>'Email'])!!}
        <label for="password" >Password</label>
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','id'=>'password']) !!}
        <div class="checkbox">
            <label>
                <input type="checkbox"
                       value="remember-me"> {!! Lang::choice('messages.check_ricordami',0) !!}
            </label>
        </div>
        {!!Form::submit(Lang::choice('messages.pulsante_accedi',0),['class'=>'btn btn-lg btn-default btn-block'])!!}
        <a href="{!! url('auth/register')!!}"
           class="btn btn-default btn-lg btn-block">{!! Lang::choice('messages.pulsante_registrati',0) !!}</a>
        <a href="{!! url('auth/password')!!}" >{!! Lang::choice('messages.password_dimenticata',0) !!}</a>
        {!!Form::close()!!}
    </div>
</div>
@stop

