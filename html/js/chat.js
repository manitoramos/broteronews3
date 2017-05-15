$(document).ready(function () {
   
    $("#send_massage").click(function () {

        $("#send_massage").addClass("disabled");

        var variabila = $("#text-massage").val();
        var mesaj = "massage=" + variabila;

            $.ajax({
                type: "POST",
                url: "/ajax/chat.php",
                cache: false,
                data: mesaj,
                success: function (test) {
                    $("#text-massage").val('');
                    //$("#success").show("fast").delay(900).hide("fast");
                    $("#success").html(test);
                    $("#send_massage").removeClass("disabled");

                }
            });
            return false;
    });

});
