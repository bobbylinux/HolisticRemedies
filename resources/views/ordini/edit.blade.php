@extends('layouts.back')
@section('content')
    <div class="row" style="text-align: center;">
        <h4>
            Spett. {{ $ordine->utenti->clienti->cognome . ' ' . $ordine->utenti->clienti->nome . ' - ' . $ordine->utenti->clienti->indirizzo . ' - ' . $ordine->utenti->clienti->cap . ' ' . $ordine->utenti->clienti->comune . ' (' . $ordine->utenti->clienti->provincia . ')'   }}</h4>
    </div>
    <div class="row" style="text-align: center;">
        <h4>Telefono: {{ $ordine->utenti->clienti->telefono . ' - E-Mail:  ' . $ordine->utenti->username}}</h4>
    </div>
{!!Form::open(array('url'=>'admin/ordini/'.$ordine->id,'method'=>'PUT','id'=>'form-ordine'))!!}
    <div class="row">
        <div class="panel-primary">
            <div class="panel-heading">
                <h5>Dettaglio ordine {{$ordine->id}}</h5>
                {!! Form::hidden('ordine',$ordine->id) !!}
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-6">Prodotto</th>
                        <th class="col-xs-2">Costo</th>
                        <th class="col-xs-1">Quantità</th>
                        <th class="col-xs-2 text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $qta_tot = 0; $idx =0; ?>
                    @foreach($ordine->prodotti as $prodotto)
                        <tr>
                            <td><?php $qta_tot =+$prodotto->pivot->quantita; ?>{{ ++$idx  }}</td>
                            <td>{{@$prodotto->prodotto}}</td>
                            <td>{{@$prodotto->pivot->costo}} €</td>
                            <td>{{@$prodotto->pivot->quantita}}</td>
                            <td class="text-right">{{ number_format($prodotto->pivot->quantita * $prodotto->pivot->costo,2)}} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <td class="col-xs-1"></td>
                        <td class="col-xs-6">Sconto</td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">-{{number_format($sconto,2) }} €</td>
                    </tr>
                    <tr>
                        <td class="col-xs-1"></td>
                        <td class="col-xs-6">Spese di spedizione </td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">{{ number_format($ordine->costospedizione,2) }} €</td>
                    </tr>
                    <tr>
                        <td class="col-xs-1"> </td>
                        <td class="col-xs-6">Tipo di pagamento </td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">{{ $ordine->pagamenti->pagamento }}</td>
                    </tr>
                    <tr>
                        <td class="col-xs-1"> </td>
                        <td class="col-xs-6"><strong>Totale</strong></td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right"><strong>{{ number_format($totale,2) }} €</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-body text-center">
            <div class="row">
                <div class="col-xs-12">
                    <h4>Stato</h4>
                </div>
            </div>
            <div class="row">
                @foreach($ordine->stati as $stato)
                    <?php $statoOrdine = $stato->id;?>
                @endforeach
                <div class="col-xs-12">
                    {!! Form::select('stato', $stati, $statoOrdine ,array('class'=>'form-control order-state')) !!}
                </div>
            </div>
            @if ($statoOrdine == 3)
                <div class="row vettura">
            @else
                 <div class="row vettura" style="display: none">
            @endif
                <div class="col-xs-12">
                    <h4>Lettera di Vettura</h4>
                </div>
            </div>
            @if ($statoOrdine == 3)
                <div class="row vettura">
            @else
                <div class="row vettura" style="display: none">
            @endif
                <div class="col-xs-12">
                    @if ($ordine->tracking != null)
                    {!! Form::text('vettura',$ordine->tracking->vettura , array('class'=>'form-control vettura-text')) !!}
                    @else
                    {!! Form::text('vettura','' , array('class'=>'form-control vettura-text')) !!}
                    @endif
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-xs-12">
                    {!! Form::submit(Lang::choice('messages.pulsante_salva',0), array('class' =>'btn btn-primary btn-block'))!!}
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-xs-12">
                    <a href="{!! url('admin/ordini') !!}" class="btn btn-danger btn-block">{{Lang::choice('messages.pulsante_annulla',0) }}</a>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@stop