@extends('layouts.basic')
@section('content')
@if ($cartcount > 0)
<div class="row">
    <div class="container-fluid">
        <div class="well" id="cart">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="col-xs-4">{!! Lang::choice('messages.carrello_prodotto',0) !!}</th>
                        <th class="col-xs-2">{!! Lang::choice('messages.carrello_costo',0) !!}</th>
                        <th class="col-xs-2">{!! Lang::choice('messages.carrello_quantita',0) !!}</th>
                        <th class="col-xs-2">{!! Lang::choice('messages.carrello_totale',0) !!}</th>
                        <th class="col-xs-1"></th>
                    </tr>
                <thead>
                <tbody>
                    @foreach($carrello as $item)
                    <tr>
                        <td class="item-product">{{$item->prodotti->prodotto}}</td>
                        <td class="item-price">{{$item->prodotti->prezzo}} &euro;</td>
                        <td class="item-units">{!! Form::select('number', [1,2,3,4,5,6,7,8,9,10], $item->quantita-1,array('class'=>'units-select', 'data-item'=> $item->id, 'data-product' => $item->prodotto, 'data-token' => csrf_token())) !!}</td>
                        <td class="item-total">{{number_format($item->prodotti->prezzo * $item->quantita,2)}} &euro;</td>
                        <td>
                            <a href="#" data-token="<?= csrf_token() ?>" class="delete-from-cart"
                               data-item="{{$item->id}}">
                                <button type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-fw fa-remove"></i> {!! Lang::choice('messages.pulsante_cancella',0) !!}
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"><a href="{!!url('/')!!}" class="btn btn-default back-to-shop"><i
                                    class="fa fa-fw fa-arrow-left"></i>{!! Lang::choice('messages.pulsante_torna_allo_shop',0) !!}</a></td>
                        <td>{!!Form::submit(Lang::choice('messages.pulsante_conferma_acquisto',0),['class'=>'btn btn btn-success cart-confirm'])!!}</td>
                    </tr>
                </tbody>
            </table>
            {!!Form::close()!!}
        </div>
    </div>
</div>
<!-- metodo pagamento-->
<div class='row'>
    <div class="container-fluid">
        <div class="well " id="payment">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="col-md-10 col-sm-9">{!! Lang::choice('messages.carrello_tipo_pagamento',0) !!}</th>
                        <th class="col-md-2 col-sm-3"></th>
                    </tr>
                <thead>
                <tbody>
                    @foreach($tipopagamento as $item)
                    <tr>
                        <td class="item-product">{{$item->pagamento}}</td>
                        <td>
                            <a href="#" data-token="<?= csrf_token() ?>"
                               class="btn btn-sm btn-success payment-select" data-item="{{$item->id}}"><i
                                    class="fa fa-fw fa-check"></i> {!! Lang::choice('messages.pulsante_scegli',0) !!}</a>
                            @if ($item->informazioni != "" && $item->informazioni != null)
                            <a href="#" data-token="<?= csrf_token() ?>"
                               class="btn btn-sm btn-primary payment-info" data-item="{{$item->id}}"><i
                                    class="fa fa-fw fa-info"></i>  {!! Lang::choice('messages.pulsante_info',0) !!}</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"><a href="#" class="btn btn-default undo-payment"><i
                                    class="fa fa-fw fa-arrow-left"></i>{!! Lang::choice('messages.pulsante_annulla',0) !!}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- riepilogo ordine-->
<div class="row">
    <div class="well" id="discount">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th class="col-lg-11">{{Lang::choice('messages.carrello_riepilogo_ordine',0)}}</th>
                </tr>
            <thead>
            <tbody>
                <tr>
                    <td class="amout col-lg-11">{{ Lang::choice('messages.carrello_totale_provvisorio',0) }}</td>
                    <td class="cart-total col-lg-1">{{$carttotal}} &euro;</td>
                </tr>
                <tr>
                    <td class="discount-units col-lg-11"> {!! Lang::choice('messages.carrello_sconto_quantita',$cartcount,['quantita' => $cartcount]) !!}</td>
                    <td class="discount-units-price col-lg-1">{{$discount}} &euro;</td>
                </tr>
                <tr>
                    <td class="shipping col-lg-11"> {!! Lang::choice('messages.carrello_spese_di_spedizione',0) !!}</td>

                    <td class="shipping-price col-lg-1">{{$spedizione}} &euro;</td>
                </tr>
                <tr class="payment-price-tr">
                    <td class="discount-payment col-lg-11"> {!! Lang::choice('messages.carrello_sconto_pagamento',0) !!}</td>
                    <td class="discount-payment-price col-lg-1"> </td>
                </tr>
                <tr>
                    <td class="discount-payment col-lg-11"> {!! Lang::choice('messages.carrello_totale',0) !!}</td>
                    <td class="cart-total-discounted col-lg-1">{{$carttotaldiscounted}} &euro;</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-xs-12" id="conferma-ordine">
                <button class="btn btn-block btn-success btn-paga-conferma" data-token="<?= csrf_token() ?>">{{Lang::choice('messages.pulsante_paga_e_conferma',0)}}</button>
            </div>
        </div>
    </div>
</div>
<div id="paypal">
    <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="bascketp">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="info@caisse.it">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="item_name" value="' . $_SESSION['idordine'] . '">
        <input type="hidden" name="amount" value="' . $importocarta . '">
        <input type="hidden" name="return" value="http://www.holisticremedies.it/esito_paypal.cfm">
        <input type="hidden" name="rm" value="2">
        <!---<table class ="box-table-a" summary="Payment" id="tbl_paypal"  >
            <thead>
            <input type="hidden" name = "idpagamento" id="pagamentopaypal" value="4"/>
            <th scope="cell" align="center">PAGAMENTO TRAMITE PAYPAL</th>
            </thead>
            <tbody>
                <tr align="center"><td><select><option selected="selected">Euro ' . $importopaypal . '</option></select></td></tr>
                <tr align="center">
                    <td><input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_buynowCC_LG.gif" id="pagapaypal" border="0" name="submitpaypal" alt="PayPal - Il sistema di pagamento online più facile e sicuro!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                    </td>
                </tr>
            </tbody>
        </table>-->
    </form>
</div>
@foreach($tipopagamento as $item)
@if ($item->informazioni != "" && $item->informazioni != null)
<!-- Modal -->
<div class="modal fade" id="{{ "modal-payment-info-" . $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{!! Lang::choice('messages.carrello_titolo_info',0) !!}</h4>
            </div>
            <div class="modal-body">
                {!! $item->informazioni !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{!! Lang::choice('messages.pulsante_chiudi',0) !!}</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@else <!--nessun elemento nel carrello-->
<div class="row" style="text-align: center">
    <div class="container-fluid">
        <h1>{!! Lang::choice('messages.carrello_vuoto',0) !!}</h1>
        <a href="{!!url('/')!!}" class="btn btn-default back-to-shop"><i
                class="fa fa-fw fa-arrow-left"></i>{!! Lang::choice('messages.pulsante_torna_allo_shop',0) !!}</a>
    </div>
</div>
@endif
@stop

