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
            },
            error: function (data) {
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
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $prezzo = value.prezzo;
                        $totale = value.totale;
                        $items = value.items;
                        $totaleScontato = value.totaleScontato;
                        $spedizione = value.spedizione;
                        $sconto = value.sconto;
                    }
                });

                $(this).closest('tr').children(".item-total").html($prezzo + " &euro;");
                $(".cart-count").html($items);
                $(".cart-total").html($totale + " &euro;");
                $(".cart-total-discounted").html($totaleScontato + " &euro;");
                $(".shipping-price").html($spedizione + " &euro;");
                $(".discount-units-price").html($sconto + " &euro;");
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
                $(this).closest('tr').remove();
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $quantita = value.quantita;
                        $totale = value.totale;
                        $totaleScontato = value.totaleScontato;
                        $spedizione = value.spedizione;
                        $sconto = value.sconto;
                    }
                });
                if ($quantita === 0) {
                    location.reload();
                } else {
                    $(".cart-count").html($quantita);
                    $(".cart-total").html($totale + " &euro;");
                    $(".cart-total-discounted").html($totaleScontato + " &euro;");
                    $(".shipping-price").html($spedizione + " &euro;");
                    $(".discount-units-price").html($sconto + " &euro;");
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
                $(this).closest('tr').remove();
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $quantita = value.quantita;
                        $totale = value.totale;
                        $totaleScontato = value.totaleScontato;
                        $spedizione = value.spedizione;
                        $sconto = value.sconto;
                        $scontoPagamento = value.scontoPagamento;
                        $percentuale = value.percentualePagamento;
                    }
                });
                $(".cart-count").html($quantita);
                $(".cart-total").html($totale + " &euro;");
                $(".cart-total-discounted").html($totaleScontato + " &euro;");
                $(".shipping-price").html($spedizione + " &euro;");
                $(".discount-units-price").html($sconto + " &euro;");
                $(".discount-payment-price").html($scontoPagamento + " &euro;");
                $(".percentage").html($percentuale);
                $(".payment-type").html($tipoPagamento);
                $('#payment').slideUp();
                $(".payment-price-tr").show();
                $("#conferma-ordine").show();
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

    $(document).on("click",".btn-paga-conferma",function(event) {
        event.preventDefault();
        alert("submit");
    });

});