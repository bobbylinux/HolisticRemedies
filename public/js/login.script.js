$(document).ready(function () {
    $(document).on("submit", ".form-signin", function (event) {
        event.preventDefault();

        var $token = $(this).data("token");

        $.ajax({
            url: "auth/login",
            type: "POST",
            async: false,
            data: {
                _method: "POST",
                username: $('#username').val(),
                password: $('#password').val(),
                _token: $token
            },
            dataType: 'json',
            success: function (data) {
                location.reload();
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            }
        });

    });
});