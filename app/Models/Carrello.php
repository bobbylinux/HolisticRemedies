<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;

class Carrello extends BaseModel
{
    protected $table = "carrello";

    private $units = 0;
    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('prodotto', 'utente');

    /**
     * The variable for system date time
     *
     */
    protected $now = null;

    /**
     * The variable for system date time
     *
     */
    private $total = 0;


    /**
     * The variable for validation rules
     *
     */
    private $rules = array(
        'prodotto' => 'required|numeric|exists:prodotti,id',
        'quantita' => 'min:1|max:100',
        'utente' => 'required|numeric|exists:utenti,id'
    );

    /**
     * The variable for validation rules
     *
     */
    private $errors = "";

    /**
     * The function for validate
     *
     * @data array
     */
    public function validate($data)
    {
        $validation = Validator::make($data, $this->rules, $this->messages);

        if ($validation->fails()) {
            // set errors and return false
            $this->errors = $validation->errors();
            return false;
        }
        return true;
    }

    /**
     * The function that incapsulate the error variable
     *
     * @errors array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->prodotto = $data['prodotto'];
        $this->quantita = $data['quantita'];
        $this->utente = $data['utente'];

        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function refresh($data)
    {
        $this->prodotto = $data['prodotto'];
        $this->quantita = $data['quantita'];
        $this->utente = $data['utente'];

        $this->save();
    }

    /**
     * The function for delete in database from view
     *
     * @data array
     */
    public function trash($id)
    {
        $this->destroy($id);
    }

    /**
     * The function return the numbers of item in the cart for logged user
     *
     * @data array
     */
    public function getCartItemsNumber($user)
    {
        $carrello = $this->where('utente', '=', $user)->get();
        $this->units = 0;
        foreach ($carrello as $item) {
            $this->units += $item->quantita;
        }
        return $this->units;
    }

    /*
    *
    * get total with discounts for logged user
    *
    * */
    public function getTotalCart($user, &$totalCart, &$quantita)
    {
        $totalCart = 0;
        $carrello = $this->with('prodotti')->where('utente', '=', $user)->get();
        $quantita = 0;

        foreach ($carrello as $item) {
            $totalCart += ($item->prodotti->prezzo * $item->quantita);
            $quantita += $item->quantita;
        }

        $totalCart = number_format($totalCart, 2);
    }

    /*
     *
     * get total with discounts for logged user
     *
     * */
    public function getTotal($user, $scontiQuantita = null, $scontiPagamento = null, $paymentId = 0, $spedizione = null, &$totalDiscounted = 0, &$discountUnits = 0, &$discountPayment = 0, &$percentagePayment = 0, &$shipping = 0, &$total = 0)
    {
        $this->total = 0;
        $carrello = $this->with('prodotti')->where('utente', '=', $user)->get();
        $quantita = 0;
        $scontoQuantita = 0;
        $scontoPagamento = 0;

        foreach ($carrello as $item) {
            $this->total += ($item->prodotti->prezzo * $item->quantita);
            $quantita += $item->quantita;
        }

        $total = number_format($this->total, 2);

        //calcolo la spesa di spedizione
        if ($spedizione != null) {
            $costoSpedizione = $spedizione->orderBy('id', 'asc')->first();
            if ($this->total <= $costoSpedizione->massimale) {
                $speseSpedizione = $costoSpedizione->costo;
            } else {
                $speseSpedizione = 0;
            }
        }

        //calcolo sconto quantita
        if ($scontiQuantita != null) {
            $tmpScontiQuantita = $scontiQuantita->orderBy('id', 'asc')->get();
            $qta_max = 0;
            $qta_min = 0;
            foreach ($tmpScontiQuantita as $item) {
                $qta_max = $item->quantita_max;
                $qta_min = $item->quantita_min;
                if ($qta_max == 0) {
                    $qta_max = $quantita;
                }
                if ($quantita >= $qta_min && $quantita <= $qta_max) {
                    $scontoQuantita = $item->sconto;
                }
            }
            $scontoQuantita = ($scontoQuantita / 100) * $this->total;
        }

        $this->total -= $scontoQuantita;

        //calcolo sconto tipo pagamento
        if ($scontiPagamento != null) {
            $scontoPagamento = $scontiPagamento->where('pagamento', '=', $paymentId)->first();
            $scontoPagamento = $scontoPagamento->sconto;
            $percentagePayment = $scontoPagamento;
            $scontoPagamento = ($scontoPagamento / 100) * $this->total;
        }

        $this->total -= $scontoPagamento;

        $totalDiscounted = number_format($this->total + $speseSpedizione, 2);
        $discountUnits = number_format($scontoQuantita, 2);
        $discountPayment = number_format($scontoPagamento, 2);
        $shipping = number_format($speseSpedizione,2);
    }

    /*
     *
     * set the relationships
     *
     * */
    public function prodotti()
    {
        return $this->belongsTo('App\Models\Prodotto', 'prodotto');
    }

}
