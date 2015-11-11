<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Holistic Remedies</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- font-flag CSS-->
    <link href="{{ url('css/flag-icon.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body style="background: #edebd6">

<!-- Content Section -->
<section id="main" class="main-section">
    <div class="container">

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
                        <?php $qta_tot = 0; $idx = 0; ?>
                        @foreach($ordine->prodotti as $prodotto)
                            <tr>
                                <td><?php $qta_tot = +$prodotto->pivot->quantita; ?>{{ ++$idx  }}</td>
                                <td>{{@$prodotto->prodotto}}</td>
                                <td>{{@$prodotto->pivot->costo}} €</td>
                                <td>{{@$prodotto->pivot->quantita}}</td>
                                <td class="text-right">{{ number_format($prodotto->pivot->quantita * $prodotto->pivot->costo,2)}}
                                    €
                                </td>
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
                            <td class="col-xs-6">Spese di spedizione</td>
                            <td class="col-xs-2"></td>
                            <td class="col-xs-1"></td>
                            <td class="text-right">{{ number_format($ordine->costospedizione,2) }} €</td>
                        </tr>
                        <tr>
                            <td class="col-xs-1"></td>
                            <td class="col-xs-6">Tipo di pagamento</td>
                            <td class="col-xs-2"></td>
                            <td class="col-xs-1"></td>
                            <td class="text-right">{{ $ordine->pagamenti->pagamento }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-1"></td>
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
    </div>
</section>

<!-- jQuery -->
<script src="{{ url('js/jquery.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>
</body>

</html>
