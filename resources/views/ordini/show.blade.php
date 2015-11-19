@extends('layouts.basic')
@section('content')
    <div class="row" style="text-align: center;">
        <h4><strong>
            {{ $ordine->utenti->clienti->cognome . ' ' . $ordine->utenti->clienti->nome . ' - ' . $ordine->utenti->clienti->indirizzo . ' - ' . $ordine->utenti->clienti->cap . ' ' . $ordine->utenti->clienti->comune . ' (' . $ordine->utenti->clienti->provincia . ')'   }}</strong></h4>
    </div>
    <div class="row" style="text-align: center;">
        <h4><strong>{{ Lang::choice('messages.telefono',0) . ' ' .  $ordine->utenti->clienti->telefono . ' - E-Mail:  ' . $ordine->utenti->username}}</strong></h4>
    
    </div>

    <div class="row">
        <div class="panel-success" style='font-size: 18px;'>
            <div class="panel-heading">
                <h5>{{ Lang::choice('messages.dettaglio_ordine',0) . ' ' . $ordine->id}}</h5>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-6">{{Lang::choice('messages.carrello_prodotto',0)}}</th>
                        <th class="col-xs-2">{{Lang::choice('messages.carrello_costo',0)}}</th>
                        <th class="col-xs-1">{{Lang::choice('messages.carrello_quantita',0)}}</th>
                        <th class="col-xs-2 text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $qta_tot = 0; $idx =0; ?>
                    @foreach($ordine->prodotti as $prodotto)
                        <tr>
                            <td><?php $qta_tot +=$prodotto->pivot->quantita; ?>{{ ++$idx  }}</td>
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
                        <td class="col-xs-6">{{Lang::choice('messages.sconto',0)}}</td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">-{{number_format($ordine->sconto,2) }} €</td>
                    </tr>
                    <tr>
                        <td class="col-xs-1"></td>
                        <td class="col-xs-6">{{Lang::choice('messages.carrello_spese_di_spedizione',0)}}</td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">{{ number_format($ordine->costospedizione,2) }} €</td>
                    </tr>
                    <tr>
                        <td class="col-xs-1"> </td>
                        <td class="col-xs-6">{{Lang::choice('messages.tipo_pagamento',0)}}</td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right">{{ $ordine->pagamenti->pagamento }}</td>
                    </tr>
                    <tr>
                        <td class="col-xs-1"> </td>
                        <td class="col-xs-6"><strong>{{Lang::choice('messages.carrello_totale',0)}}</strong></td>
                        <td class="col-xs-2"></td>
                        <td class="col-xs-1"></td>
                        <td class="text-right"><strong>{{ number_format($totale,2) }} €</strong></td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-success btn-print hidden-print">{{Lang::choice('messages.stampa',0)}}</button>
                        <a href="{!! url('/') !!}" class="btn btn-block btn-default hidden-print">{!! Lang::choice('messages.pulsante_home_page',0) !!}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4>{{Lang::choice('messages.conferma_mail',0)}}</h4>
                    </div>
                </div>
            </div>
                @if ($ordine->pagamenti->id == 2)
                <div class="panel-footer text-center">
                    <b>ATTENZIONE:</b><br>per il pagamento attraverso bonifico bancario &egrave; necessario<br>
                    1) dare disposizione di bonifico per l'importo indicato sulla conferma d'ordine a favore di:<br>
                    <b>Holistic Remedies Sas - Via Piave 99 -
                        50068 Rufina (FI) -
                        Iban IT96L0616038040100000000607</b> <br>
                    2)  una volta effettuato il bonifico inviare la ricevuta relativa all'indirizzo mail <br><a href="mailto:info@caisse.it">info@caisse.it</a> e anche a <a href="mailto:ordini@caisse.it">ordini@caisse.it</a> <br>oppure un fax al numero 055/8395989<p>
                </div>
                @endif
        </div>
    </div>
@stop