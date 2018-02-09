/*gestione carrello*/
$(document).ready(function () {

    $(document).on("click", ".add-to-cart", function (event) {
        event.preventDefault();
        var $url = $(this).attr("href");
        var $product = $(this).data("product");
        var $units = $(this).parent().prev().find(".units  option:selected").text();
        var $token = $(this).data("token");

        $.ajax({
            url: $url,
            type: "POST",
            async: false,
            data: {
                _method: "POST",
                prodotto: $product,
                quantita: $units,
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                $units = data.units;
                $(".cart-count").html($units);
                $("#modal-cart").modal("show");
                window.setTimeout(function(){
                    $("#modal-cart").modal("hide");
                }, 2000); // your 2 seconds delay before it calls the modal function
            },
            error: function (data) {
                $("#modal-cart-error").modal("show");
                window.setTimeout(function(){
                    $("#modal-cart-error").modal("hide");
                }, 2000); // your 2 seconds delay before it calls the modal function
                console.error(data);
            }
        });
    });

    $(document).on("change", ".units-select", function (event) {
        event.preventDefault();
        var $units = parseInt($(this).val()) + 1;
        var $item = $(this).data("item");
        var $product = $(this).data("product");
        var $token = $(this).data("token");
        var $url = "carrello/" + $item;

        if ($item === null || $item === "") {
            return;
        }

        $.ajax({
            context: this, /*used for pass object dom into ajax*/
            url: $url,
            type: "POST",
            async: false,
            data: {
                _method: "PUT",
                item: $item,
                quantita: $units,
                prodotto: $product,
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                var $totale = 0;
                var $prezzo = 0;
                var $items = 0;
                var $totaleScontato = 0;
                var $spedizione = 0;
                var $sconto = 0;
                var $totaleMin = 0;
                var $percentualeScontoSuTotale = 0;
                var $scontoSuTotale = 0;
                var $prezzoItems = 0;
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $prezzo = value.prezzo;
                        $quantita = value.quantita;
                        $totale = value.totale;
                        $items = value.items;
                        $totaleScontato = value.totaleScontato;
                        $spedizione = value.spedizione;
                        $sconto = value.sconto;
                        $totaleMin = value.totale_min;
                        $percentualeScontoSuTotale = value.percentualeScontoTotaleOrdine;
                        $scontoSuTotale = value.scontoTotaleOrdine;
                    }
                });

                $(this).parent('td').parent('tr').children(".item-total").children(".item-total-span").html($prezzo);
                $(".cart-count").html($items);
                $(".cart-total").html($totale);
                $(".cart-total-discounted").html($totaleScontato);
                $(".shipping-price").html($spedizione);
                $(".discount-units-price").html($sconto);
                $(".discount-total-price").html($scontoSuTotale);
                $(".percentage-total-discount").html($percentualeScontoSuTotale);
                $(".total-min").html($totaleMin);
                ($scontoSuTotale > 0) ? $(".discount-on-total-row").show() : $(".discount-on-total-row").hide();
            },
            error: function (data) {
                console.error(data);
            }
        });
    });

    $(document).on("click", ".delete-from-cart", function (event) {
        event.preventDefault();
        var $item = $(this).data("item");
        var $token = $(this).data("token");
        var $url = "carrello/" + $item;

        if ($item === null || $item === "") {
            return;
        }

        $.ajax({
            context: this, /*used for pass object dom into ajax*/
            url: $url,
            type: "POST",
            async: false,
            data: {
                _method: "DELETE",
                item: $item,
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                var $quantita = 0;
                var $totale = 0;
                var $totaleScontato = 0;
                var $spedizione = 0;
                var $sconto = 0;
                var $totaleMin = 0;
                var $percentualeScontoSuTotale = 0;
                var $scontoSuTotale = 0;
                $(this).closest('tr').remove();
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $quantita = value.quantita;
                        $totale = value.totale;
                        $totaleScontato = value.totaleScontato;
                        $spedizione = value.spedizione;
                        $sconto = value.sconto;
                        $totaleMin = value.totale_min;
                        $percentualeScontoSuTotale = value.percentualeScontoTotaleOrdine;
                        $scontoSuTotale = value.scontoTotaleOrdine;
                    }
                });
                if ($quantita === 0) {
                    location.reload();
                } else {
                    $(".cart-count").html($quantita);
                    $(".cart-total").html($totale);
                    $(".cart-total-discounted").html($totaleScontato);
                    $(".shipping-price").html($spedizione);
                    $(".discount-units-price").html($sconto);
                    $(".discount-total-price").html($scontoSuTotale);
                    $(".percentage-total-discount").html($percentualeScontoSuTotale);
                    $(".total-min").html($totaleMin);
                    ($scontoSuTotale > 0) ? $(".discount-on-total-row").show() : $(".discount-on-total-row").hide();
                }
            },
            error: function (data) {
                console.error(data);
            }
        });
    });

    $(document).on("click", ".payment-select", function (event) {
        event.preventDefault();

        var $item = $(this).data("item");
        var $token = $(this).data("token");
        var $url = "carrello/" + $item + "/pagamento";
        var $tipoPagamento = $(this).closest("td").prev('td').text();
        if ($item === null || $item === "") {
            return;
        }

        $.ajax({
            context: this, /*used for pass object dom into ajax*/
            url: $url,
            type: "POST",
            async: false,
            data: {
                _method: "GET",
                item: $item,
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                var $quantita = 0;
                var $totale = 0;
                var $totaleScontato = 0;
                var $spedizione = 0;
                var $sconto = 0;
                var $scontoPagamento = 0;
                var $percentuale = 0;
                var $formPagamento = "";
                //$(this).closest('tr').remove();
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $quantita = value.quantita;
                        $totale = value.totale;
                        $totaleScontato = value.totaleScontato;
                        $spedizione = value.spedizione;
                        $sconto = value.sconto;
                        $scontoPagamento = value.scontoPagamento;
                        $percentuale = value.percentualePagamento;
                        $formPagamento = value.formPagamento;
                    }
                });
                $(".cart-count").html($quantita);
                $(".cart-total").html($totale);
                $(".cart-total-discounted").html($totaleScontato);
                $(".shipping-price").html($spedizione);
                $(".discount-units-price").html($sconto);
                $(".discount-payment-price").html($scontoPagamento);
                $(".percentage").html($percentuale);
                $(".payment-type").html($tipoPagamento);
                $("#payment-type").val($item);
                $('#payment').slideUp();
                $(".payment-price-tr").show();
                $("#conferma-ordine").show();
                $("#annulla-ordine").show();
                $(".btn-annulla-ordine").show();
                $(".forms").empty();
                $(".forms").append($formPagamento);

            },
            error: function (data) {
                console.error(data);
            }
        });

    });

    $(document).on("click", ".cart-confirm", function (event) {
        event.preventDefault();
        $('#cart').slideUp();
        $('#payment').slideDown();
    });

    $(document).on("click", ".payment-info", function (event) {
        event.preventDefault();
        $id = "#modal-payment-info-" + $(this).data("item");
        $($id).modal("show");
    });

    $(document).on("click",".undo-shipping",function(event){
        event.preventDefault();
        $('#shipping').slideUp();
        $('#payment').slideDown();
    });

    $(document).on("click",".undo-payment",function(event){
        event.preventDefault();
        $('#payment').slideUp();
        $('#cart').slideDown();
    });

    $(document).on("click",".btn-annulla-ordine",function(event){
        event.preventDefault();
        $('#payment').slideDown();
        $('#conferma-ordine').hide();
        $(this).hide();
    });

    $(document).on("click",".btn-paga-conferma",function(event) {
        event.preventDefault();
        $.blockUI({message: $('#wait-msg')});
        var $url = "admin/ordini";
        var $token = $(this).data("token");
        var $discountUnits = $(".discount-units-price").html();
        var $discountPayment = $(".discount-payment-price").html();
        var $discountTotal = $(".discount-total-price").html();
        var $cartTotalDiscounted = $(".cart-total-discounted").html();
        var $cartTotal = $(".cart-total").html();
        var $paymenType = $("#payment-type").val();
        var $shippingPrice = $(".shipping-price").html();
        $.ajax({
            context: this, /*used for pass object dom into ajax*/
            url: $url,
            type: "POST",
            async: false,
            data: {
                _method: "POST",
                _token: $token,
                discountUnits: $discountUnits,
                discountPayment: $discountPayment,
                discountTotal: $discountTotal,
                cartTotal: $cartTotal,
                cartTotalDiscounted: $cartTotalDiscounted,
                paymentType: $paymenType,
                shippingPrice: $shippingPrice,
            },
            dataType: 'json',
            success: function (data) {
                if (data.code === "200") {
                    var $item_name = "";
                    var $return = "";
                    var $amount = 0;
                    var $username = "";
                    var $name = "";
                    var $amountCard="";
                    $.each(data, function (key, value) { // First Level
                        if (key === "item") {
                            $item_name = value.item_name.toString();
                            $amount = value.amount;
                            $amountCard = value.amount.replace(".","");
                            $return = value.return;
                            $username = value.username;
                            $name = value.name;
                        }
                    });
                    var $action = $("#payment-form").attr("action");
                    var $res = $action.replace("{ordine}",$item_name);
                    $("#payment-form").attr("action",$res);
                    $("#item-name").val($item_name+'/00');
                    $("#amount").val($amount);
                    $("#amount-card").val($amountCard);
                    $("#return").val($return);
                    $("#_nome").val($name);
                    $("#_email").val($username);
                    $("#payment-form").submit();
                } else {
                    $(document).ajaxStop($.unblockUI);
                }
            },
            error: function (data) {
                console.error(data);
                $(document).ajaxStop($.unblockUI);
            }
        });
    });

    $(document).on("click",".btn-print",function(){
        window.print();
    });

});