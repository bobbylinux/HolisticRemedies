$(document).ready(function () {
    $(document).on("submit", ".form-signin", function (event) {
        event.preventDefault();
        $(".login-errors").empty();
        var $token = $(this).data("token");

        $.ajax({
            url: "auth/login",
            type: "POST",
            async: false,
            data: {
                _method: "POST",
                username: $('#username').val(),
                password: $('#password').val(),
                remember: $('#remember-me').val(),
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                //
                if (data.code === "200") {

                    location.reload();
                } else {
                    $(".login-errors").html(data.msg);

                }
            },
            error: function(data){
                console.log(data);
                if (data.code === "200") {

                    location.reload();
                } else {
                    $(".login-errors").html(data.msg);

                }
            }
        });

    });
});