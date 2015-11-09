@extends('layouts.basic')
@section('content')
    <div class="row" style="text-align: center;">
        <h4>
            Spett. {{ $ordine->utenti->clienti->cognome . ' ' . $ordine->utenti->clienti->nome . ' - ' . $ordine->utenti->clienti->indirizzo . ' - ' . $ordine->utenti->clienti->cap . ' ' . $ordine->utenti->clienti->comune . ' (' . $ordine->utenti->clienti->provincia . ')'   }}</h4>
    </div>
    <div class="row" style="text-align: center;">
        <h4>Telefono: {{ $ordine->utenti->clienti->telefono . ' - E-Mail:  ' . $ordine->utenti->username}}</h4>
    </div>

    <div class="row">
        <div class="panel-primary">
            <div class="panel-heading">
                <h5>Dettaglio ordine {{$ordine->id}}</h5>
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
                        <td class="col-xs-6">Sconto per {{$qta_tot}} pezzi</td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">{{number_format($ordine->sconto,2) }} €</td>
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
@stop