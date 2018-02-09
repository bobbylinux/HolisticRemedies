<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demystifying Email Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
</html>
<body style="background: #edebd6; margin: 0; padding: 0;">
<table align="center" border="1" cellpadding="0" cellspacing="0" width="800">
    <td align="center" bgcolor="#62643f" style="padding: 40px 0 30px 0;">
        <a href="http://www.condor.globeit.com" target="_blank"><img src="http://www.condor.globeit.com/img/intro.png" alt="Creating Email Magic" width="700" height="270" style="display: block;" /></a>
    </td>
    <tr>
        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px; text-align:center; font-family: Arial, sans-serif;">
            <h4>Spett. {{ $ordine->utenti->clienti->cognome . ' ' . $ordine->utenti->clienti->nome . ' - ' . $ordine->utenti->clienti->indirizzo . ' - ' . $ordine->utenti->clienti->cap . ' ' . $ordine->utenti->clienti->comune . ' (' . $ordine->utenti->clienti->provincia . ')'   }}</h4>
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="font-size: 18px; font-weight: bold;">
                        Dettaglio ordine {{$ordine->id}}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0 30px 0;">
                        <table style="text-align: right;">
                            <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="250">Prodotto</th>
                                <th width="150">Costo</th>
                                <th width="100">Qta</th>
                                <th width="150">Totale</th>
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
                                    <td>{{ number_format($prodotto->pivot->quantita * $prodotto->pivot->costo,2)}} €
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table style="text-align: right;">
                            <tbody>
                            <tr>
                                <td width="50"></td>
                                <td width="250">Sconto per {{$qta_tot}} pezzi</td>
                                <td width="150"></td>
                                <td width="100"></td>
                                <td width="150">{{number_format($ordine->sconto,2) }} €</td>
                            </tr>
                            <tr>
                                <td width="20"></td>
                                <td width="250">Spese di spedizione</td>
                                <td width="60"></td>
                                <td width="50"></td>
                                <td width="100">{{ number_format($ordine->costospedizione,2) }} €</td>
                            </tr>
                            <tr>
                                <td width="20"></td>
                                <td width="250">Tipo di pagamento</td>
                                <td width="60"></td>
                                <td width="50"></td>
                                <td width="100">{{ $ordine->pagamenti->pagamento }}</td>
                            </tr>
                            <tr>
                                <td width="20"></td>
                                <td width="250"><strong>Totale</strong></td>
                                <td width="60"></td>
                                <td width="50"></td>
                                <td width="100"><strong>{{ number_format($totale,2) }} €</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($ordine->pagamenti->id == 2)
                            <div class="panel-footer text-center">
                                <strong>ATTENZIONE:</strong><br>per il pagamento attraverso bonifico bancario &egrave; necessario<br>
                                1) dare disposizione di bonifico per l'importo indicato sulla conferma d'ordine a favore di:<br>
                                <b>Holistic Remedies Sas - Via Piave 99 -
                                    50068 Rufina (FI) -
                                    Iban IT96L0616038040100000000607</b> <br>
                                2)  una volta effettuato il bonifico inviare la ricevuta relativa all'indirizzo mail <br><a href="mailto:info@caisse.it">info@caisse.it</a> e anche a <a href="mailto:ordini@caisse.it">ordini@caisse.it</a><p>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#62643f" style="padding: 30px 30px 30px 30px;">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="75%" style="color:#edebd6; text-align: center; font-size:19px;">
                        <h6>Caisse Formula è un integratore alimentare prodotto da: Herb Works - Guelph Ontario - Canada</h6>
                        <h6>Distribuito in Italia da: Holistic Remedies - Via Piave, 99 - 50068 Rufina (Firenze)<br>
                            Tel.: +39.055. 8395388 - Mail: info@caisse.it<br>
                            Iscrizione REA Firenze 503598 - Registro Imprese 19717 - P. IVA 04957430483</h6>
                    </td>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="https://www.facebook.com/CaisseFormula/" target="_blank">
                                        <img src="http://www.condor.globeit.com/img/fb.png') !!}" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>