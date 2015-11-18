--estrazione utenti
select id, username, password,(case when amministratore = 1  then 1 else 2 end) as ruolo, 1 as confermato, obsoleto as cancellato
from utenti;

--estrazione clienti
SELECT cl.id as id, cl.nome as nome, cl.cognome as cognome, cl.societa as societa, cl.indirizzo as indirizzo, cl.cap as cap,
	cl.comune as comune, cl.provincia as provincia, cl.nazione as nazione, cl.telefono as telefono, cl.fax as fax, ut.id as utente, 
	ut.obsoleto as cancellato
from 	clienti cl, utenti ut
where cl.id = ut.idcliente
and ut.id is not null;

--estrazione ordini testa
select id, idutente as utente, costo, costospedizione, sconto, idpagamento as tipo_pagamento, 0 as cancellato, dataordine as data_creazione
from ordini_testa;

--estrazione ordini dettaglio
select id, idordinetesta as ordine, idprodotto as prodotto, qta as quantita, prezzo as costo
from ordini_dettaglio;

--estrazione ordini stato
select distinct idordine as ordine, stato, data as data_creazione
from ordini_stato;

--estrazuibe ordine vettura
select idordine as ordine, vettura as vettura,data as data_crazione from
ordini_vettura;
