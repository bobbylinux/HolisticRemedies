/**
 * Created by roberto on 10/10/15.
 */
$(document).ready(function () {
    var $url_delete = "";
    var $token = "";

    $(document).on("click", ".btn-delete", function (event) {
        event.preventDefault();

        if ($token === null || $token === "") {
            return;
        }

        $.ajax({
            context: this, /*used for pass object dom into ajax*/
            url: $url_delete,
            type: "POST",
            async: false,
            data: {
                _method: "DELETE",
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                $("#modal-delete").modal("hide");
                location.reload();
            },
            error: function (data) {
                console.error(data);
                $("#modal-delete").modal("hide");
            }
        });
    });

    $(document).on("click", ".btn-cancella", function (event) {
        event.preventDefault();
        $url_delete = $(this).attr("href");
        $token = $(this).data('token');
        $("#modal-delete").modal("show");
    });

    $(document).on("change",".order-state",function() {
        var $id = $(this).val();
        if ($id === "3") {
            $(".vettura").show();
        } else {
            $(".vettura-text").val("");
            $(".vettura").hide();
        }
    });
});