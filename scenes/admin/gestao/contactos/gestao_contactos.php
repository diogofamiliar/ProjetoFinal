<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
    include "../../../../core/connect.php";
    include '../../../../headers/admin_header.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- datepicker CSS-->
    <link href="../../../../css/datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Gestão Contactos Úteis</title>



    <script language="JavaScript" type="text/javascript">
    function checkDelete() {
        var x = $('[name="id_contacto_util[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende eliminar os contactos selecionados?");
                if(confirmed){
                document.getElementById('form1').submit();
                return true;
                }
            }else{
            swal("Aviso!", 
            "Selecione os contactos que pretende eliminar!", 
            "error");
            return false;
            }
        }
    </script>
  </head>


<body>

<div class="d-flex justify-content-center">
    <div class="card col-sm-11">
      <div class="card-header d-flex justify-content-between">
        <button class="btn btn-success" id="myButton" type="button" name="answer"> Novo contacto</button>
        <h3>Gestão de Contactos Úteis</h3>
        <a class="btn btn-danger mx-1" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar contacto</a>
      </div>
      <div class="card" id="card-novo-contacto" style="display:none;">
        <form id="form3" method="POST" action="adicionar_contacto.php">
        <div class="card-header">
          <h5 id="h1-centered">Insira os dados do novo contacto:</h5>
        </div>
        <div class="card-body">
          <div class="form-group" id="codcontactoSelector">
            <label class="form-label">Tipo de Contacto:</label>
            <div>
              <input type="text" form="form3" name="tipo_contacto" class="form-control" placeholder="Insira o tipo de contacto" Required>  
            </div>
          </div>
          <div class="form-group">
            <div>
              <label class="form-label">Contacto:</label>
              <input type="text" form="form3" class="form-control" name="contacto" id="inputContacto" placeholder="Introduza um numero de 9 digitos" pattern="[0-9]{9}">
            </div>         
          </div>
          <div class="form-group">
            <label class="form-label">Condominio:</label>
            <div>
                <select id="gruposelector" name="id_condominio" class="form-control" required>
                    <option value=""></option>
                    <?php
                    $query_1="SELECT id_condominio, nome, cod_condominio FROM condominio";
                    $result = mysqli_query($conn, $query_1);
                    while($row_result=mysqli_fetch_assoc($result)){ ?>
                <option value="<?php echo $row_result['id_condominio']; ?>"><?php echo utf8_encode($row_result['cod_condominio']); ?> - <?php echo utf8_encode($row_result['nome']); ?></option> <?php
                    }
                        ?>
                </select>
            </div>
          </div>    
          <div class="d-flex justify-content-center">
            <button form="form3" class="btn btn-success" id="submit" type="submit"> Adicionar</button>
          </div>
        </div>
        </form>
      </div>
      <div class="card-body">
          <form method="POST" id="form1" action="eliminar_contactos.php">
          <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"/></th>
                    <th>Tipo de Contacto</th>
                    <th>Contacto</th>  
                    <th>Condomínio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT contacto_util.id_contacto_util, contacto, tipo_de_contacto, condominio.nome 
              FROM contacto_util INNER JOIN condominio_contacto 
              ON condominio_contacto.id_contacto_util=contacto_util.id_contacto_util 
              INNER JOIN condominio ON condominio.id_condominio=condominio_contacto.id_condominio";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
                <tr>
                    <td class="col-sm-1"><input type="checkbox" name="id_contacto_util[]" value="<?php echo $rows['id_contacto_util']; ?>" multiple></td>
                    <td><?php echo utf8_encode($rows["tipo_de_contacto"]); ?></td>
                    <td><?php echo utf8_encode($rows["contacto"]); ?></td>
                    <td><?php echo utf8_encode($rows["nome"]); ?></td>
                    <td class="d-flex justify-content-center">
                        <form method="POST" id="form2" action="alterar_contacto.php">

                          <button form="form2" name="id_contacto_util" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows['id_contacto_util']); ?>"> Alterar</button>

                        </form>
                    </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
        </table>
          </form>
      </div>  
      </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../../../js/jquery-3.4.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Compara as duas pw's introduzidas -->
<script src="../../../../js/compare_pw.js"></script>
<!-- Optional JavaScript -->
<script src="../../../../js/datepicker.min.js"></script>
<script src="../../../../js/i18n/datepicker.pt.js"></script>
<!-- Optional JavaScript -->
<script>
$('#myButton').click(function() {
  $('#card-novo-contacto').toggle('slow', function() {
    // Animation complete.
  });
});
</script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    
    $('#data').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "25%", "targets": 1 },
        { "width": "20%", "targets": 2 },
        { "width": "20%", "targets": 3 },
        { "width": "10%", "targets": 4 }
      ],
      select: true,
      "scrollX": true
    });
  });
</script>
<script>
  $("#checkAll").change(function () {
  $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>

<?php
  if(isset($_COOKIE["contacto_alterado"])){
?>
      <script>
      swal({
            title: "Contacto alterado!",
            text: "Contacto alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["contacto_adicionado"])){
?>
      <script>
      swal({
            title: "Contacto adicionado!",
            text: "O seu registo foi efetuado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["contacto_eliminado"])){
?>
      <script>
      swal({
            title: "Contacto eliminado!",
            text: "Os contactos foram eliminados com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
