{!!Form::open(array('url'=>'/auth/register','method'=>'POST'))!!}
    {!! csrf_field() !!} 
    <div class="col-md-6"> Name <input type="text" name="name" value="{{ old('name') }}"> </div> 
    <div> Email <input type="email" name="username" value="{{ old('username') }}"> </div>
    <div> Password <input type="password" name="password"> </div> 
    <div class="col-md-6"> Confirm Password <input type="password" name="password_confirmation"> </div> 
    <div> <button type="submit">Register</button> </div> 
{!!Form::close()!!}