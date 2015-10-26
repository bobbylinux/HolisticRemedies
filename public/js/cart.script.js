/*gestione carrello*/
$(document).ready(function () {

    /*events*/
    $(document).on("click", ".add-to-cart", function (event) {
        event.preventDefault();
        var $url = $(this).attr("href");
        var $product = $(this).data("product");
        var $units =$(this).parent().prev().find(".units  option:selected").text();
        var $token = $(this).data("token");
        console.log("prodotto="+$product+"/quantità="+$units);

        $.ajax({
            url : $url,
            type: "POST",
            async: false,
            data: {
                _method: "POST",
                prodotto: $product,
                quantita: $units,
                _token: $token
            },
            dataType : 'json',
            success : function (data) {
                $units = data.units;
                $(".cart-count").html($units);
                console.log(data);
            },
            error : function (data) {
                console.log(data);
            }
        });
    });

});