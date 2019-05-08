$(document).ready(function() {
    $("#tipo_incidente").on("change", function() {
        if ($(this).val() === "5") {//COLOCAR O ID CORRESPONDENTE AO ID "OUTRO"
            $("#otherType").show();
        }
        else {
            $("#otherType").hide();
        }
    });
});