{!!Form::open(array('url'=>'/auth/login'.$prodotto->id,'method'=>'POST'))!!}
    {!! csrf_field() !!} 
    <div> Email <input type="email" name="email" value="{{ old('email') }}"> </div> 
    <div> Password <input type="password" name="password" id="password"> </div> 
    <div> <input type="checkbox" name="remember"> Remember Me </div> <div> 
        <button type="submit">Login</button> </div> 
{!!Form::close()!!}