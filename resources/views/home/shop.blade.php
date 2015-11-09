@if (!Auth::check())

@endif
<div class="row">
    <div class="jumbotron">
        <div class="container">
            <h1>{!! Lang::choice('messages.shop_titolo',0) !!}</h1>

            <p>{!!  Lang::choice('messages.shop_titolo_jumbotron',0) !!}</p>

            <p>{!! Lang::choice('messages.shop_contenuto_jumbotron',0) !!}</p>

            <p><a class="btn btn-default btn-lg" href="#" data-toggle="modal" data-target="#modal-shop"
                  role="button">{!! Lang::choice('messages.shop_come_ordinare',0) !!}</a>
                <a class="btn btn-success btn-lg" href="auth/register"
                   role="button">{!! Lang::choice('messages.pulsante_registrati',0) !!}</a>
                <a class="btn btn-warning btn-lg" href="auth/login"
                   role="button">{!! Lang::choice('messages.pulsante_accedi',0) !!}</a>
            </p>
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
<!-- Modal -->
<div class="modal fade" id="modal-shop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3>{!! Lang::choice('messages.shop_come_ordinare',0) !!}</h3>
            </div>
            <div class="modal-body">
                @if (Lang::has('messages.shop_come_ordinare_paragrafo_1'))
                    <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_1',0)!!}</p>
                @endif
                @if (Lang::has('messages.shop_come_ordinare_paragrafo_2'))
                    <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_2',0)!!}</p>
                @endif
                @if (Lang::has('messages.shop_come_ordinare_paragrafo_3'))
                    <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_3',0)!!}</p>
                @endif
                    @if (Lang::has('messages.shop_come_ordinare_paragrafo_4'))
                        <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_4',0)!!}</p>
                    @endif
                    @if (Lang::has('messages.shop_come_ordinare_paragrafo_5'))
                        <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_5',0)!!}</p>
                    @endif
                    @if (Lang::has('messages.shop_come_ordinare_paragrafo_6'))
                        <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_6',0)!!}</p>
                    @endif
                    @if (Lang::has('messages.shop_come_ordinare_paragrafo_7'))
                        <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_7',0)!!}</p>
                    @endif
                    @if (Lang::has('messages.shop_come_ordinare_paragrafo_8'))
                        <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_8',0)!!}</p>
                    @endif
                    @if (Lang::has('messages.shop_come_ordinare_paragrafo_9'))
                        <p>{!!Lang::choice('messages.shop_come_ordinare_paragrafo_9',0)!!}</p>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button"
                        data-dismiss="modal" class="btn btn-default">{!! Lang::choice('messages.pulsante_chiudi',0) !!}</button>
            </div>
        </div>
    </div>
</div>