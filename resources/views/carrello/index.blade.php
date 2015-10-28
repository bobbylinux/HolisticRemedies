@extends('layouts.basic')
@section('content')
    <div class="row">
        <div class="container-fluid">
            <table class="table table-bordered table-hover table-striped">
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
                        <td class="item-price">{{$item->prodotti->prezzo}}</td>
                        <td class="item-units">{!! Form::select('number', [0,1,2,3,4,5,6,7,8,9,10], $item->quantita,array('class'=>'units-select', 'data-item'=> $item->id, 'data-product' => $item->prodotto, 'data-token' => csrf_token())) !!}</td>
                        <td class="item-total">{{number_format($item->prodotti->prezzo * $item->quantita,2)}}</td>
                        <td>
                            <a href="{{ url('/admin/sconti/pagamento/'.$item['id']) }}"
                               class="btn btn-danger btn-cancella" data-item = "{{$item->id}}"
                               data-token="<?= csrf_token() ?>">{{ Lang::choice('messages.pulsante_elimina',0) }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

