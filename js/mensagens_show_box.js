$(document).ready(function() {
    $("#tipo_destinatario").on("change", function() {
        if ($(this).val() === "utilizador") {//COLOCAR O ID CORRESPONDENTE AO ID "OUTRO"
            $("#mostra_user").hide();
            $("#otherType").hide();
            $("#otherType").hide();
            $("#otherType").hide();

        }
        else {
            $("#otherType").hide();
        }
    });
});