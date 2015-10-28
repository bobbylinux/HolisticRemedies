@extends('layouts.basic')
@section('content')
<div class="row">
    <div class="container-fluid">
        <table class="table">
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
                    <td class="item-units">{!! Form::select('number', [0,1,2,3,4,5,6,7,8,9,10], $item->quantita,array('class'=>'units-select', 'data-item'=> $item->id, 'data-product' => $item->prodotto, 'data-token' => csrf_token())) !!}</td>
                    <td class="item-total">{{number_format($item->prodotti->prezzo * $item->quantita,2)}} &euro;</td>
                    <td>
                        <a href="{{ url('/carrello'.$item->id) }}" data-token="<?= csrf_token() ?>" class="delete-from-cart" data-item="{{$item->id}}"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-fw fa-remove"></i></button></a>
                    </td>
                </tr>                    
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2" class="cart-total">{{$carttotal }} &euro;</td>
                </tr>
                <tr>
                    <td colspan="3"><a href="{!!url('/')!!}" class="btn btn-default back-to-shop"><i class="fa fa-fw fa-arrow-left"></i>Torna allo Shop</a></td>
                    <td colspan="2"><a href="#" class="btn btn-success back-to-shop" data-token="<?= csrf_token() ?>" ><i class="fa fa-fw fa-check"></i>Conferma Acquisto</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
       </div>
</div>
@stop

