function fill_tipo_manutencao() {
  var x = document.getElementById("cab_tipo_manutencao").value;
  $(".form-control.tipo_manutencao").val(x);
}


function fill_data() {
    var x = document.getElementById("calendario").value;
    $(".datepicker-here.form-control.class_calendar").val(x);
}

function fill_prioridade() {
    var x = document.getElementById("cab_prioridade").value;
    $(".form-control.prioridade").val(x);
}

function fill_equipa() {
    var x = document.getElementById("cab_equipa").value;
    $(".form-control.equipa").val(x);
  }