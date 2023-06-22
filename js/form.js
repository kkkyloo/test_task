$(document).ready(function () {

    $("#testForm").on("submit", function (event) {
        event.preventDefault();

        $.ajax({
            url: 'form.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response) {
                    $("#container").hide();
                    $("#testForm").hide();
                    $(document).ready(function () {
                        $("h1").html('Форма отправлена!');
                    });

                } else {
                    $(document).ready(function () {
                        $("#container").html('Ваша заявка уходила в течении 5 минут!');
                    });
                }
            }
        });

    });
});