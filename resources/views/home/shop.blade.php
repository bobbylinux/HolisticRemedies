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
            <a href="{!! url('auth/register')!!}"
               class="btn btn-default btn-lg btn-block">{!! Lang::choice('messages.pulsante_registrati',0) !!}</a>
            {!!Form::close()!!}

        </div>
    </div>
@endif
<div class="row">
    <div class="jumbotron">
        <div class="container">
            <h1>{!! Lang::choice('messages.shop_titolo',0) !!}</h1>

            <p>{!!  Lang::choice('messages.shop_titolo_jumbotron',0) !!}</p>

            <p>{!! Lang::choice('messages.shop_contenuto_jumbotron',0) !!}</p>

            <p><a class="btn btn-default btn-lg" href="#"
                  role="button">{!! Lang::choice('messages.shop_come_ordinare',0) !!}</a></p>
        </div>
    </div>
</div>
<div class="row">
    @foreach($prodotti as $prodotto)
        <div class="col-sm-6 col-lg-3 col-md-3">
            <div class="thumbnail product-section">
                <img src="{!! url('uploads/' . $prodotto->immagini->nomefile) !!}" alt="">

                <div class="caption">
                    <h5 class="pull-right">&euro; {{number_format($prodotto->prezzo,2)}}</h5>
                    <h5><a href="#">{{$prodotto->prodotto}}</a></h5>

                    <p>{!! $prodotto->descrizione !!} </p>

                    <p>
                        <label for="units">{!! Lang::choice('messages.shop_quantita',0) !!}</label>
                        <select class="form-control units">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </p>
                    <p><a class="btn btn-success add-to-cart" href="{!!url('carrello')!!}" role="button"
                          data-product="{{@$prodotto->id}}" data-token="{!! csrf_token() !!}"><i
                                    class="fa fa-fw fa-shopping-cart"></i>{!! Lang::choice('messages.shop_aggiungi_al_carrello',0) !!}
                        </a></p>
                </div>
            </div>
        </div>
    @endforeach
</div>