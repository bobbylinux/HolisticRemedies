<div class="row">
    <div class="col-lg-12">
        <h2>{!!Lang::choice('messages.shop_titolo',0)!!}</h2>
    </div>
</div>
@if (!Auth::check())
<div class="row hidden-md hidden-lg hidden-print">
    <div class="col-md-4 col-md-offset-4">
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'auth/login','class'=>'form-signin','style'=>'margin-top:10px'])!!}
        <label for="inputEmail" class="sr-only">Email</label>
        {!! Form::text('username','',['class'=>'form-control','type'=>'email','id'=>'username','placeholder'=>'Email'])!!}
        <label for="inputPassword" class="sr-only">Password</label>
        {!! Form::password('password',['class'=>'form-control']) !!}
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> {!! Lang::choice('messages.check_ricordami',0) !!}
            </label>
        </div>
        {!!Form::submit(Lang::choice('messages.pulsante_accedi',0),['class'=>'btn btn-lg btn-default btn-block'])!!}
        <a href="{!! url('auth/register')!!}" class="btn btn-default btn-lg btn-block">{!! Lang::choice('messages.pulsante_registrati',0) !!}</a>
        {!!Form::close()!!}

    </div>
</div>
@else

@endif