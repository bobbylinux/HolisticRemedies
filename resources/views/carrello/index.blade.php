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
                                <td class="item-total">
                                    <span class="item-total-span">{{number_format($item->prodotti->prezzo * $item->quantita,2)}}</span>
                                    &euro;
                                </td>
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
                                            class="fa fa-fw fa-arrow-left"></i>{!! Lang::choice('messages.pulsante_torna_allo_shop',0) !!}
                                </a></td>
                            <td><a href="#" class="btn btn-success cart-confirm"><i
                                            class="fa fa-fw fa-arrow-right"></i>{!!  Lang::choice('messages.pulsante_conferma_acquisto',0)!!}
                                </a></td>
                        </tr>
                        </tbody>
                    </table>
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
                                                class="fa fa-fw fa-check"></i> {!! Lang::choice('messages.pulsante_scegli',0) !!}
                                    </a>
                                    @if ($item->informazioni != "" && $item->informazioni != null)
                                        <a href="#" data-token="<?= csrf_token() ?>"
                                           class="btn btn-sm btn-primary payment-info" data-item="{{$item->id}}"><i
                                                    class="fa fa-fw fa-info"></i> {!! Lang::choice('messages.pulsante_info',0) !!}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4"><a href="#" class="btn btn-default undo-payment"><i
                                            class="fa fa-fw fa-arrow-left"></i>{!! Lang::choice('messages.pulsante_annulla',0) !!}
                                </a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- riepilogo ordine-->
        <div class="row">
            <div class="well" id="summary">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th class="col-lg-11">{{Lang::choice('messages.carrello_riepilogo_ordine',0)}}</th>
                    </tr>
                    <thead>
                    <tbody>
                    <tr>
                        <td class="col-lg-11"><span
                                    class="amout">{{ Lang::choice('messages.carrello_totale_provvisorio',0) }}</span>
                        </td>
                        <td class="col-lg-1"><span class="cart-total">{{$carttotal}}</span> &euro;</td>
                    </tr>
                    <tr class="discount-on-total-row" style="{!! ($discountTotal == 0) ? "display:none" : ""!!}">
                        <td class="col-lg-11"><span
                                    class="discount-total">{!! Lang::choice('messages.carrello_sconto_totale',0,['totale_min' => $totale_min, 'sconto' => $percentageDiscountTotal]) !!}</span>
                        </td>
                        <td class="col-lg-1"><span class="discount-total-price">{{$discountTotal}}</span> &euro;</td>
                    </tr>
                    @if ($discountUnits > 0)
                        <tr>
                            <td class="col-lg-11"><span
                                        class="discount-units">{!! Lang::choice('messages.carrello_sconto_quantita',$cartcount,['quantita' => $cartcount]) !!}</span>
                            </td>
                            <td class="col-lg-1"><span class="discount-units-price">{{$discountUnits}}</span> &euro;
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="col-lg-11"><span
                                    class="shipping">{!! Lang::choice('messages.carrello_spese_di_spedizione',0) !!}</span>
                        </td>

                        <td class="col-lg-1"><span class="shipping-price">{{$spedizione}}</span> &euro;</td>
                    </tr>
                    <tr class="payment-price-tr">
                        <td class="col-lg-11"><span
                                    class="discount-payment">{!! Lang::choice('messages.carrello_sconto_pagamento',0) !!}</span>
                        </td>
                        <td class="col-lg-1"><span class="discount-payment-price"></span> &euro;</td>
                        <input type="hidden" name="payment-type" id="payment-type" value="">
                    </tr>
                    <tr>
                        <td class="col-lg-11">{!! Lang::choice('messages.carrello_totale',0) !!}</td>
                        <td class="col-lg-1"><span class="cart-total-discounted ">{{$carttotaldiscounted}}</span> &euro;
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-12" id="conferma-ordine">
                        <button class="btn btn-block btn-success btn-paga-conferma"
                                data-token="<?= csrf_token() ?>">{{Lang::choice('messages.pulsante_paga_e_conferma',0)}}</button>
                    </div>
                </div>
                <div class="row" style="margin-top:2%;">
                    <div class="col-xs-12" id="annulla-ordine">
                        <button class="btn btn-block btn-default btn-annulla-ordine"
                                data-token="<?= csrf_token() ?>">{{Lang::choice('messages.pulsante_annulla',0)}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="forms">

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
                                <h4 class="modal-title"
                                    id="myModalLabel">{!! Lang::choice('messages.carrello_titolo_info',0) !!}</h4>
                            </div>
                            <div class="modal-body">
                                {!! $item->informazioni !!}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{!! Lang::choice('messages.pulsante_chiudi',0) !!}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else <!--nessun elemento nel carrello-->
    <div class="row" style="text-align: center;">
        <div class="col-xs-12">
            <div class="panel" style="background:#edebd6; padding:1%; margin-top:10%;">
                <h1>{!! Lang::choice('messages.carrello_vuoto',0) !!}</h1>
                <a href="{!!url('/')!!}" class="btn btn-default btn-block back-to-shop"><i
                            class="fa fa-fw fa-arrow-left"></i>{!! Lang::choice('messages.pulsante_torna_allo_shop',0) !!}
                </a>
            </div>
        </div>
    </div>
    @endif
@stop

