<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
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
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Gestão fornecedores</title>



    <script language="JavaScript" type="text/javascript">
    function checkDelete() {
        var x = $('[name="id_fornecedor[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende eliminar os fornecedores eliminados?");
                if(confirmed){
                document.getElementById('form1').submit();
                return true;
                }
            }else{
            swal("Aviso!", 
            "Selecione os fornecedores que pretende eliminar!", 
            "error");
            return false;
            }
        }
    </script>
  </head>


<body>

<div class="container">
    <?php include "../../../../assets/breadcrumbers/bc_gestao_fornecedores.php" ?>        
    <div class="card col-sm-12">
      <div class="card-header d-flex justify-content-between">
        <button class="btn btn-success" id="myButton" type="button" name="answer"> Novo fornecedor</button>
        <h3>Gestão de fornecedores</h3>
        <a class="btn btn-danger mx-1" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar fornecedor</a>
      </div>
      <div class="card" id="card-novo-condominio" style="display:none;">
        <form id="form3" method="POST" action="adicionar_fornecedor.php">
        <div class="card-header">
          <h5 id="h1-centered">Insira os dados do novo fornecedor:</h5>
        </div>
        <div class="card-body">
          <div class="form-group" id="codCondominioSelector">
            <label class="form-label">Nome:</label>
            <div>
              <input type="text" form="form3" name="nome" class="form-control" placeholder="Insira o nome completo"/ Required>  
            </div>
          </div>  
          <div class="form-group">
            <div>
              <label class="form-label">Morada:</label>
              <input type="text" form="form3" class="form-control" name="morada" id="inputNome" placeholder="Insira a morada"  required>
            </div>          
            <div>
              <label class="form-label">Telemovel:</label>
              <input type="tel" form="form3" name="telemovel" class="form-control col-sm-8" required pattern="[0-9]{9}" placeholder="Introduza um numero de 9 digitos">
            </div>
            <div>
              <label class="form-label">Email:</label>
              <input type="email" form="form3" name="email" class="form-control" required>
            </div>
          </div> 
          <div class="d-flex justify-content-center">
            <button form="form3" class="btn btn-success" type="submit"> Adicionar</button>
          </div>
        </div>
        </form>
      </div>
      <div class="card-body">
          <form method="POST" id="form1" action="eliminar_fornecedores.php">
          <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"/></th>
                    <th>Nome</th>
                    <th>Email</th>  
                    <th>Telemóvel</th>
                    <th>Morada</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT id_fornecedor, nome, email, telemovel, morada FROM fornecedor";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
                <tr>
                    <td class="col-sm-1"><input type="checkbox" name="id_fornecedor[]" value="<?php echo $rows['id_fornecedor']; ?>" multiple></td>
                    <td><?php echo utf8_encode($rows["nome"]); ?></td>
                    <td><?php echo utf8_encode($rows["email"]); ?></td>
                    <td><?php echo utf8_encode($rows["telemovel"]); ?></td>
                    <td><?php echo utf8_encode($rows["morada"]); ?></td>
                    <td class="d-flex justify-content-center">
                        <form method="POST" id="form2" action="alterar_fornecedor.php">
                          <button form="form2" name="id_fornecedor" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_fornecedor"]); ?>"> Editar</button>
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
        { "width": "20%", "targets": 1 },
        { "width": "15%", "targets": 2 },
        { "width": "15%", "targets": 3 },
        { "width": "30%", "targets": 4 },
        { "width": "15%", "targets": 5 }
      ],
      "language": {
        "search": "Pesquisar:",
        "info":           "A mostrar _START_ de _END_ num total de _TOTAL_ resultados",
        "lengthMenu":     "Resultados por página: _MENU_",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Ultimo",
          "next":       "Próximo",
          "previous":   "Anterior"
        }
      },
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
  if(isset($_COOKIE["fornecedor_alterado"])){
?>
      <script>
      swal({
            title: "Fornecedor alterado!",
            text: "Fornecedor alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["fornecedor_adicionado"])){
?>
      <script>
      swal({
            title: "Fornecedor adicionado!",
            text: "O seu registo foi efetuado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["fornecedor_eliminado"])){
?>
      <script>
      swal({
            title: "Fornecedor eliminado!",
            text: "Os fornecedores foram eliminados com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
