@extends('layouts.basic')
@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="well">
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
                            <a href="#" data-token="<?= csrf_token() ?>" class="delete-from-cart" data-item="{{$item->id}}"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-fw fa-remove"></i>Cancella</button></a>
                        </td>
                    </tr>                    
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2" class="cart-total">{{$carttotal}} &euro;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><a href="{!!url('/')!!}" class="btn btn-default back-to-shop"><i class="fa fa-fw fa-arrow-left"></i>Torna allo Shop</a></td>
                        <td colspan="2">{!!Form::submit(Lang::choice('messages.pulsante_conferma_acquisto',0),['class'=>'btn btn btn-success cart-confirm'])!!}</td>
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
        <div class="collapse" id="pagamento">
            <div class="well">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="col-sm-10">{!! Lang::choice('messages.carrello_tipo_pagamento',0) !!}</th>
                            <th class="col-sm-2"></th>
                        </tr>
                    <thead>
                    <tbody>
                        @foreach($tipopagamento as $item)
                        <tr>
                            <td class="item-product">{{$item->pagamento}}</td>
                            <td>    
                                <a href="#" data-token="<?= csrf_token() ?>" class="btn btn-xs btn-success payment-select" data-item="{{$item->id}}"><i class="fa fa-fw fa-check"></i> scegli</a>
                                @if ($item->informazioni != "" && $item->informazioni != null)
                                <a href="#" data-token="<?= csrf_token() ?>" class="btn btn-xs btn-primary payment-info" data-item="{{$item->id}}"><i class="fa fa-fw fa-info"></i> info</a>
                                @endif
                            </td>
                        </tr>                    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- metodo pagamento-->

<!--spedizione -->
<div class='row'>
    <div class="container-fluid">
        <div class="collapse" id="spedizione">
            <div class="well">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="col-sm-10">{!! Lang::choice('messages.carrello_tipo_pagamento',0) !!}</th>
                            <th class="col-sm-2"></th>
                        </tr>
                    <thead>
                    <tbody>
                        @foreach($tipopagamento as $item)
                        <tr>
                            <td class="item-product">{{$item->pagamento}}</td>
                            <td>    
                                <a href="#" data-token="<?= csrf_token() ?>" class="btn btn-xs btn-success payment-select" data-item="{{$item->id}}"><i class="fa fa-fw fa-check"></i> scegli</a>
                                @if ($item->informazioni != "" && $item->informazioni != null)
                                <a href="#" data-token="<?= csrf_token() ?>" class="btn btn-xs btn-primary payment-info" data-item="{{$item->id}}"><i class="fa fa-fw fa-info"></i> info</a>
                                @endif
                            </td>
                        </tr>                    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@foreach($tipopagamento as $item)
@if ($item->informazioni != "" && $item->informazioni != null)
<!-- Modal -->
<div class="modal fade" id="{{ "modal-payment-info-" . $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                {!! $item->informazioni !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
@endif 
@endforeach

@stop

