<div class="row">
    <div class="col-lg-12">
        <h2>{!!Lang::choice('messages.shop_titolo',0)!!}</h2>
    </div>
</div>
@if (!Auth::check())
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'/login','class'=>'form-signin','style'=>''])!!}
        <h3 class="form-signin-heading">Accedi</h3>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        {!! Form::password('password',['class'=>'form-control']) !!}
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Ricordami
            </label>
        </div>
        {!!Form::submit('Login',['class'=>'btn btn-lg btn-default btn-block'])!!}
        {!!Form::submit('Registrati',['class'=>'btn btn-lg btn-default btn-block'])!!}
        {!!Form::close()!!}
    </div>
</div>
@else

@endif