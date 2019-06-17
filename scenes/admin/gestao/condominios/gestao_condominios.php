<?php /*
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador']) && isset ($_POST['id_incidente'])){
    $id_incidente=$_POST['id_incidente'];
}else header('Location: ../../index.php');
*/?>
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
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Gestão condomínios</title>



    <script language="JavaScript" type="text/javascript">
    function checkDelete() {
        var x = $('[name="id_condominio[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende eliminar as mensagens?");
                if(confirmed){
                document.getElementById('form1').submit();
                return true;
                }
            }else{
            swal("Aviso!", 
            "Selecione os condominios que pretende eliminar!", 
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
        <button class="btn btn-success" id="myButton" type="button" name="answer"> Novo condominio</button>
        <h3>Gestão de condomínios</h3>
        <a class="btn btn-danger mx-1" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar</a>
      </div>
      <div class="card" id="card-novo-condominio" style="display:none;">
        <form id="form3" method="POST" action="adicionar_condominio.php">
        <div class="card-header">
          <h5 id="h1-centered">Insira os dados do novo condominio:</h5>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="row col-sm-4">
              <label for="inputCodCondominio" class="col-sm-4 col-form-control">Código:</label>
              <input type="text" form="form3" name="cod_condominio" class="form-control col-sm-7" id="inputCodCondominio" placeholder="Código do condomínio"  required>
            </div>
            <div class="row col-sm-8">
              <label for="inputNome" class="col-sm-2 col-form-control">Nome:</label>
              <input type="text" form="form3" name="nome" class="form-control col-sm-10" id="inputNome" placeholder="Insira o nome do condomínio"  required>
            </div>
          </div>
          <div class="form-group row">
              <label for="inputMorada" class="col-sm-1 col-form-control">Morada:</label>
              <div class="col-sm-10">
                  <input type="text" form="form3" name="morada" class="form-control" id="inputMorada" placeholder="Insira a morada do condomínio"  required>
              </div>
          </div>
          <div class="d-flex justify-content-center">
            <button form="form3" class="btn btn-success" type="submit"> Adicionar</button>
          </div>
        </div>
        </form>
      </div>
      <div class="card-body">
          <form method="POST" id="form1" action="eliminar_condominios.php">
          <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
            <thead>
              <tr>
                <th><input type="checkbox" id="checkAll"/></th>
                <th>COD</th>
                <th>Nome</th>
                <th>Morada</th>  
                <th></th>
                </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT id_condominio, cod_condominio, nome, morada FROM condominio";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
                <tr>
                    <td class="col-sm-1"><input type="checkbox" name="id_condominio[]" value="<?php echo $rows['id_condominio']; ?>" multiple></td>
                    <td><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
                    <td><?php echo utf8_encode($rows["nome"]); ?></td>
                    <td><?php echo utf8_encode($rows["morada"]); ?></td>
                    <td class="d-flex justify-content-center">
                        <form method="POST" id="form2" action="alterar_condominio.php">
                          <button form="form2" name="condominio" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_condominio"]); ?>"> Editar</button>
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
<!-- Optional JavaScript -->
<script>
$('#myButton').click(function() {
  $('#card-novo-condominio').toggle('slow', function() {
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
        { "width": "10%", "targets": 1 },
        { "width": "30%", "targets": 2 },
        { "width": "40%", "targets": 3 },
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
  if(isset($_COOKIE["condominio_adicionado"])){
?>
      <script>
      swal({
            title: "Condominio adicionado!",
            text: "Condomínio adicionado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["condominio_alterado"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "O condomínio foi alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

<?php
  if(isset($_COOKIE["condominio_eliminado"])){
?>
      <script>
      swal({
            title: "Condominio eliminado!",
            text: "Os condomínios foram eliminadas com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
