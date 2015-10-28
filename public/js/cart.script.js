/*gestione carrello*/
$(document).ready(function () {

    /*events*/
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
                console.log(data);
            }
        });
    });

    $(document).on("change", ".units-select", function (event) {
        event.preventDefault();
        var $units = $(this).val();
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
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $prezzo = value.prezzo;
                        $totale = value.totale;
                        $items = value.items;
                    }
                });

                $(this).closest('tr').children(".item-total").html($prezzo+" &euro;");
                $(".cart-count").html($items);
                $(".cart-total").html($totale+" &euro;");
            },
            error: function (data) {
                console.log(data);
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
                $(this).closest('tr').remove();
                $.each(data, function (key, value) { // First Level
                    if (key === "item") {
                        $quantita = value.quantita;
                        $totale = value.totale;
                    }
                });
                $(".cart-count").html($quantita);
                $(".cart-total").html($totale+" &euro;");
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
})
        ;