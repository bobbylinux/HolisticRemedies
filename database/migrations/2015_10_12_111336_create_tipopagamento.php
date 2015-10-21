<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipopagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipopagamento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pagamento', 50);
            $table->string('informazioni', 2000)->nullable();
            $table->boolean('cancellato')->default(false); //flag di cancellazione: true = cancellato, false = non cancellato, default = false
            $table->timestamp('data_creazione')->default(DB::raw('CURRENT_TIMESTAMP')); //data creazione default sysdate
            $table->timestamp('data_modifica')->default(DB::raw('CURRENT_TIMESTAMP')); //data modifica default sysdate
            $table->timestamp('data_cancellazione')->nullable(); //data cancellazione
        });

        DB::table('tipopagamento')->insert(
            array(
                array('pagamento' => 'Contrassegno', 'informazioni' => '<p>solo per ordini con spedizione in Italia - only for Italy</p>'),
                array('pagamento' => 'Bonifico Bancario', 'informazioni' => '<p>     <b>ATTENZIONE:</b><br>per il pagamento attraverso bonifico bancario &egrave; necessario<br>1) dare disposizione di bonifico per l\'importo indicato sulla conferma d\'ordine a favore di:<br>     <b>Holistic Remedies Sas - Via Piave 99 -          50068 Rufina (FI) -          Iban IT96L0616038040100000000607</b><br> 2)  una volta effettuato il bonifico inviare la ricevuta relativa all\'indirizzo mail <br><a class="mailto" href="mailto:info@caisse.it" target="_blank">info@caisse.it</a> e anche a <a class="mailto" href="mailto:ordini@caisse.it" target="_blank">ordini@caisse.it</a><br>specificando il numero di ordine di 4 cifre che si legge sotto "dettaglio ordine" <br>oppure un fax al numero 055/8395989  </p>'),
                array('pagamento' => 'Carta Di Credito', 'informazioni' => '<p>         <img src="Grafica/cartecredito.jpg"/>  <br>       <strong>(Collegamento Garantito da SOAR)</strong>         <br>         <br>         In caso di problemi con la carta di credito (pagamento non a buon fine, errori di connessione) &egrave; sufficiente         <br>         azzerare l\'ordine e poi ripeterlo         <br>         In case of any problems with your Credit Card, clear the order firs and than repeat it      </p>'),
                array('pagamento' => 'PayPal', 'informazioni' => null),
            ));
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipopagamento');
    }
}
